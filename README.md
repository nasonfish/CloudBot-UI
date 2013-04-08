This is a web 'interface' made by nasonfish for showing factoids, and soon, other things

To install, you need something like Apache.

Place these files in the directory `/home/cloudbot/persist/(anyfoldername)/`

You can change this to wherever your cloudbot is running, just where the bot.py is, and up into the persist and up one more.

Set Apache to point to this

For example,

    <VirtualHost *>
      ServerName refract.nasonfish.com
      DocumentRoot /home/cloudbot/persist/site/
    </VirtualHost>

Is what I use.

`http://refract.nasonfish.com/` points to this, which is in the directory `/persist/`.
So far, it only works if the database name is `EsperNet.db`, I will need to add a config to make this work with other places.

This is just an early thing, more is coming, right now it's just kind of bad and in Alpha.

-nasonfish
