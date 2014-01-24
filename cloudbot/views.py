from cloudbot import app, db
from flask import render_template
from cloudbot.models import Quotes, Memory
from cloudbot.utils import render_template_or_json

@app.route('/')
def index():
    return render_template_or_json('index.html')

@app.route('/quotes')
def quotes():
    quotes = Quotes.query.filter_by(deleted=0).all()
    return render_template_or_json('quotes.html', quotes=quotes)

@app.route('/factoids')
def factoids():
    factoids = Memory.query.all()
    return render_template_or_json('factoids.html', factoids=factoids)