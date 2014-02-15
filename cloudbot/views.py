from cloudbot import app, db
from flask import render_template, request, redirect, url_for, jsonify
from cloudbot.models import Quotes, Memory
from cloudbot.utils import render_template_or_json
import re

@app.route('/')
def index():
    return render_template_or_json('index.html')

@app.route('/quotes')
def quotes():
    quotes = Quotes.query.filter_by(deleted=0).all()
    return render_template_or_json('quotes.html', quotes=quotes)

@app.route('/quote/submit', methods=['POST'])
def submit_quote():
    add_nick = request.form['add_nick']
    # hopefully not stupid...
    matches = re.search('^<?([^ ]+)(?(1)>) (.*)$', request.form['message'])
    nick = matches.group(1)
    message = matches.group(2)
    Quotes('#web-interface', nick, add_nick, message)
    return redirect(url_for('.quotes'))

@app.route('/factoids')
def factoids():
    factoids = Memory.query.all()
    return render_template_or_json('factoids.html', factoids=factoids)

@app.route('/factoid/ajax_eval', methods=['POST'])
def factoid_eval():
    inp = request.form['input']
    factoid = Memory.query.filter_by(word=request.form['word']).first_or_404()
    return jsonify({'result': factoid.evaluate(inp)})

@app.route('/commands')
def commands():
    #import os
    #dir = os.path
    #return jsonify({"Sorry."})
    variables = {}
    a = open("/home/nasonfish/Projects/Python/CloudBot/plugins/util/hook.py", "r")
    #exec(a, variables)
    a = open("/home/nasonfish/Projects/Python/CloudBot/plugins/8ball.py", "r")
    #exec(a, variables)
    return jsonify(variables)

@app.route('/hello')
def hello():
    a = ["debian.xml", "ubuntu.xml", "gentoo.xml", "elementaryos.xml", "redhat.xml", "fedora.xml", "arch_linux.xml"]
    return render_template_or_json('hello.html', temps=a)

@app.route('/factoid/add', methods=['POST'])
def add_factoid():
    post_data = request.form
    word = post_data['word']
    data = post_data['data']
    Memory(word, data)
    return redirect(url_for('.factoids'))

