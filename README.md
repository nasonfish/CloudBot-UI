## CloudBot-UI/Python

CloudBot-UI is currently being rewritten in Python with a cleaner backend and a nicer design.

Based off of panel2 by Centarra, this new branch is built using Flask and SQLAlchemy, to make for easier access of the database and for easier routing that doesn't put all the logic into tons of loops in the index page.

Currently it should run fine from the way it is when you stick it in a folder in `<cloudbot_root>/persist/` and run `python run.py`.

You can edit `run.py` to change port settings easily, and hopefully in the future you'll be able to use more than just the EsperNet db file.
