from cloudbot import db

class LastFM(db.Model):
    __tablename__ = 'lastfm'
    nick = db.Column(db.String(32), primary_key=True)
    acc = db.Column(db.String(32))

class Memory(db.Model):
    __tablename__ = 'mem'
    word = db.Column(db.String(32), primary_key=True)
    data = db.Column(db.Text())
    nick = db.Column(db.String(32))

    def is_python(self):
        return self.data.startswith("<py>")

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


# no tell table