from flask import Flask, session
from flask.ext.sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config.from_pyfile('cloudbot.conf')  # SQLALCHEMY_DATABASE_URI = "sqlite:///../../EsperNet.db"
#db = SQLAlchemy(app)  "sqlite:///../../" + session['network']
#if not session['network']:
#    session['network'] = app.config['NETWORKS'][0]
db = SQLAlchemy(app)
#db.engine

import cloudbot.models
import cloudbot.views

app.add_url_rule('/static/<path:filename>',
                 endpoint='static',
                 view_func=app.send_static_file)