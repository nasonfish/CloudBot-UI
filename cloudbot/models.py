from cloudbot import db
import datetime
import time as now

class LastFM(db.Model):
    __tablename__ = 'lastfm'
    nick = db.Column(db.String(32), primary_key=True)
    acc = db.Column(db.String(32))

class Memory(db.Model):
    __tablename__ = 'mem'
    word = db.Column(db.String(32), primary_key=True)
    data = db.Column(db.Text())
    nick = db.Column(db.String(32))

    def __init__(self, word, data, nick="guest"):
        self.word = word
        self.data = data
        self.nick = nick

        db.session.add(self)
        db.session.commit()

    def is_python(self):
        return self.data.startswith("<py>")

    def evaluate(self, input=""):  # todo onkeydown for submitting, startswith <py>: 'Hint: the variables are ...'
        return eval(("input='''%s''';nick='your_nick';bot_nick='CloudBot';chan='web_interface'" % input)
                    + self.data.replace("<py>", ""))  # substr? and, eval probably isn't a good idea with this.

    def _serialize(self):
        return dict(word=self.word, data=self.data, nick=self.nick)

    def is_url(self):
        return self.data.startswith("<url>")


class Quotes(db.Model):
    __tablename__ = 'quote'
    chan = db.Column(db.String(32), primary_key=True)
    nick = db.Column(db.String(32), primary_key=True)
    add_nick = db.Column(db.String(32))
    msg = db.Column(db.Text(), primary_key=True)
    time = db.Column(db.Float())
    deleted = db.Column(db.Boolean(), default=0)

    def __init__(self, chan, nick, add_nick, msg, time=now.time(), deleted=0):
        self.chan = chan
        self.nick = nick
        self.add_nick = add_nick
        self.msg = msg
        self.time = time
        self.deleted = deleted

        db.session.add(self)
        db.session.commit()

    def get_time(self):
        return datetime.datetime.fromtimestamp(self.time).strftime("%a, %b %d, %Y (%I:%M %p)")

    def _serialize(self):
        return dict(chan=self.chan, nick=self.nick, add_nick=self.add_nick,
                    msg=self.msg, time=self.time, deleted=self.deleted)

class SteamRankings(db.Model):
    __tablename__ = 'steam_rankings'
    id = db.Column(db.Integer(), primary_key=True)
    value = db.Column(db.Text())
    count = db.Column(db.Integer)

class Weather(db.Model):
    __tablename__ = 'weather'
    nick = db.Column(db.String(32), primary_key=True)
    loc = db.Column(db.Text())


class Seen(db.Model):
    __tablename__ = 'seen_user'
    name = db.Column(db.String(32), primary_key=True)
    time = db.Column(db.Float())  # not sure what it is stored as
    quote = db.Column(db.Text())
    chan = db.Column(db.String(32), primary_key=True)
    host = db.Column(db.String(128))


# no tell table, that's private for the user
