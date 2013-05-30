# Summary

This is a web 'interface' made by nasonfish for showing factoids, and soon, other things

# Installation

To install, you need something like Apache.

Place these files in the directory `/home/cloudbot/persist/site/`, changing `/home/cloudbot/` to wherever your cloudbot is running from.

You can put these files there by moving them there over sftp or ftp or something of that sort, or you could use git if you have that available to you, using a command like `git clone git@github.com:nasonfish/CloudBot-UI.git`

I will use `/home/cloudbot/` in my examples, as that is where I run my bot from.

Set Apache to point to `/home/cloudbot/persist/site` in the `httpd.conf` (`/etc/httpd/conf/httpd.conf`)

For example, I would add this to my `httpd.conf`.

    <VirtualHost *>
      ServerName refract.nasonfish.com
      DocumentRoot /home/cloudbot/persist/site/
    </VirtualHost>


`http://refract.nasonfish.com/` will now point to this.

# Configuration

Okay, now you've got Apache pointing to the directory, but you still need to configure it for it to work.

I have the default configuration file named config.default.php. You can fill this file out with the information it asks for, and then copy it to config.php.

The program will not use the default config, only the one you renamed. When this interface is updated, the config might too, so you should keep the config.default.php so you can merge it.

# End

This is just an early thing, more is coming, right now it's just kind of bad and in Alpha. I hope you enjoy it a little.

-nasonfish
