# ===========================================================
# This is a flask project
# ----------------------------------------------------------
# Docmentation:
# --------------
# template_folder = 'templates' This is to get the folder
# render_template = This for get template
# route() = by default accept GET request and we can add POST request for it 
# WTForms: Is a flexible forms validation and rendering library for python web development.  
# cursor() == This method coming from 'DictCursor' object in MySQL  
# ===========================================================

from flask import Flask, render_template, flash, redirect, url_for, session, request, logging 
#from data import Articles # This object contine the Articles object
from flask_mysqldb import MySQL
from wtforms import Form, StringField, TextAreaField, PasswordField, validators
from passlib.hash import sha256_crypt
from functools import wraps

# Name of app 
app = Flask(__name__)

# Config MYSQL
app.config['MYSQL_HOST']        = 'localhost'
app.config['MYSQL_USER']        = 'root'
app.config['MYSQL_PASSWORD']    = ''
app.config['MYSQL_DB']          = 'myFlaskapp'
app.config['MYSQL_CURSORCLASS'] = 'DictCursor'

# Init MYSQL
mysql = MySQL(app)

#Articles = Articles()

# Index
@app.route('/') # To select the path or route
def index():
    return render_template('home.html')

# About
@app.route('/about/')
def about():
    return render_template('about.html')

# Articles
@app.route('/articles')
def articles():
    # Create cursor 
    cur = mysql.connection.cursor()

    # Get articles
    result = cur.execute("SELECT * FROM articles")

    articles = cur.fetchall()

    if result > 0:
        return render_template('articles.html', articles = articles)
    else:
        msg = 'No Articles Yet'
        return render_template('articles.html', message = msg)

    # Close Connection
    cur.close()


# Singole article 
@app.route('/article/<string:id>/')
def article(id):
    # Create Cursor
    cur = mysql.connection.cursor()

    # Get article
    result = cur.execute("SELECT * FROM articles WHERE id = %s", [id] )

    article = cur.fetchone() 

    return render_template('article.html', art = article)


# This class for registration form 
# In this class we will create the field form
# We will use it for validation the form 
# StringField('input label name -> like Name, Username, validators -> to check the input field is empty or not')
class RegisterForm(Form):
    name        = StringField('Name', [validators.Length(min = 1, max = 50)])
    username    = StringField('Username', [validators.Length(min = 4, max = 25)])
    email       = StringField('Email', [validators.Length(min = 1, max = 50)])
    password    = PasswordField('Password', [
                validators.DataRequired(),
                validators.EqualTo('confirm', message = 'Password do not mach')
    ])
    confirm     = PasswordField('Confirm Password')

# User register 
# Get data from the form and check if it POST or not and it is validation or not and send it to database
# request = is the method from flask 
@app.route('/register', methods = ['GET', 'POST'])
def register():
    form = RegisterForm(request.form) 
    if request.method == 'POST' and form.validate():
        name        = form.name.data
        username    = form.username.data
        email       = form.email.data
        password    = sha256_crypt.encrypt(str(form.password.data))

        # Create Cursor
        cur = mysql.connection.cursor()

        # Execute Query
        cur.execute("INSERT INTO users(name, email, username, password) VALUES(%s, %s, %s, %s)", (name, email, username, password) )

        # Commit to DB
        mysql.connection.commit()

        # Close Connection
        cur.close()

        # flash = this method for send messages
        flash('You are now registered')
        return redirect(url_for('index'))

    return render_template('register.html', form = form) # form == RegisterForm 

# User login
@app.route('/login', methods = ['GET', 'POST'])
def login():
    # 
    if request.method == 'POST':
        # Get form field
        username = request.form['username']
        password_candidate = request.form['password'] # This is the password that user write it in the input field.

        # Create cursor 
        cur = mysql.connection.cursor()

        # Get user by username
        result = cur.execute("SELECT * FROM users WHERE username = %s", [username])

        # If user fiend
        if result > 0:
            # Get stored hash
            data = cur.fetchone()
            password = data['password']

            # Compare password 
            if sha256_crypt.verify(password_candidate, password):
                # if valied user create the session for him
                # Note: logged_in, username ==> this name of session to call it.
                session['logged_in'] = True
                session['username']  = username

                # send messages to user 
                flash('You are login', 'success')
                return redirect(url_for('dashboard'))

            else:
                error = 'Invalid Password'
                return render_template('login.html', error = error)

            # Close the connection if there is no users found
            cur.close()
        else:
            error = 'Username not found'
            return render_template('login.html', error = error)

    return render_template('login.html')

# Check if user logged in 
def is_logged_in(f):
    @wraps(f)
    def wrap(*args, **kwargs):
        # If the user logged in the function let him go to dashboard
        if 'logged_in' in session:
            return f(*args, **kwargs)
          # If not redirect him to dashboard  
        else: 
            flash('Unauthorized, Please login', 'danger')
            return redirect(url_for('login'))
    return wrap       

# Logout
@app.route('/logout')
def logout():
    session.clear()
    flash('You are logged out', 'success')
    return redirect(url_for('login'))


# Dashboard 
@app.route('/dashboard')
@is_logged_in # this method to check if user register or not  
def dashboard():
    # Create cursor 
    cur = mysql.connection.cursor()

    # Get articles
    result = cur.execute("SELECT * FROM articles")

    articles = cur.fetchall()

    if result > 0:
        return render_template('dashboard.html', articles = articles)
    else:
        msg = 'No Articles Yet'
        return render_template('dashboard.html', message = msg)

    # Close Connection
    cur.close()


# Class Articles Form
class ArticlesForm(Form):
    title = StringField('title', [validators.Length(min = 1, max = 200)] )
    body  = TextAreaField('Body', [validators.Length(min = 30)] )

# Add Article
@app.route('/add_article', methods = ['GET', 'POST'])
@is_logged_in # this method to check if user register or not  
def add_articles():

    form = ArticlesForm(request.form)
    if request.method == 'POST' and form.validate():
    
        title = form.title.data
        body  = form.body.data
                
        # Create Cursor
        cur = mysql.connection.cursor()

        # Execute
        cur.execute("INSERT INTO articles(title, body, author) VALUES(%s, %s, %s)", (title, body, session['username']) )

        # Commit To DB
        mysql.connection.commit()

        # Close Connection
        cur.close()

        # Messages
        flash("Article Created", "success")

        return redirect(url_for('dashboard'))

    return render_template('add_article.html', form = form)

# Edit Article
# <string:id> == To pass the article ID to the method
@app.route('/edit_article/<string:id>', methods = ['GET', 'POST'] )
@is_logged_in # this method to check if user register or not  
def edit_article(id):
    # Create Cursor
    cur = mysql.connection.cursor()

    # Get Article by id   
    result = cur.execute("SELECT * FROM articles WHERE id = %s", [id] )

    # Article
    article = cur.fetchone()

    # Get form 
    form = ArticlesForm(request.form)

    # Populate article form fields
    form.title.data = article['title']
    form.body.data  = article['body']

    if request.method == 'POST' and form.validate():

        # Stor form title and body
        title = request.form['title']
        body  = request.form['body']

        # Create cursor 
        cur = mysql.connection.cursor()

        # Execute
        cur.execute("UPDATE articles SET title = %s, body = %s WHERE id = %s", [title, body, id] ) 

        # Commit To DB
        mysql.connection.commit()

        # Close Connection 
        cur.close()

        flash("Article Updated", "success")
        return redirect(url_for('dashboard'))
    return render_template('edit_article.html', form = form)
    
# Delete Article    
@app.route('/data_article/<string:id>', methods = ['POST'])
@is_logged_in
def delete_article(id):
    # Create article
    cur = mysql.connection.cursor()

    # Execute
    cur.execute("DELETE FROM articles WHERE id = %s", [id])

    # Commit To DB
    mysql.connection.commit()

    # Close Connection
    cur.close()

    flash("Article Deleted", "success")
    return redirect(url_for('dashboard'))

if __name__ == '__main__':
    app.secret_key = 'tito007' # this key just for more secret 
    app.run(debug=True)