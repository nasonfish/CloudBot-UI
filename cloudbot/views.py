from cloudbot import app, db
from flask import render_template
from cloudbot.models import Quotes
from cloudbot.utils import render_template_or_json

@app.route('/')
def index():
    return render_template_or_json('index.html')

@app.route('/quotes')
def quotes():
    quotes = Quotes.query.filter_by(deleted=0).all()
    return render_template_or_json('quotes.html', quotes=quotes)