![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# LimitHeight

A simple PocketMine-MP plugin to limit the build height on your server.

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP 1.7dev API 3.0.0-ALPHA7 -> 3.0.0-ALPHA11

## Overview

**LimitHeight** is a simple plugin that let you limit the build height on your server.

**EvolSoft Website:** https://www.evolsoft.tk

**This Plugin uses the New API. You can't install it on old versions of PocketMine.**

## Donate

Please support the development of this plugin with a small donation by clicking [:dollar: here](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=flavius.c.1999@gmail.com&lc=US&item_name=www.evolsoft.tk&no_note=0&cn=&curency_code=EUR&bn=PP-DonationsBF:btn_donateCC_LG.gif:NonHosted). 
Your small donation will help me paying web hosting, domains, buying programs (such as IDEs, debuggers, etc...) and new hardware to improve software development. Thank you :smile:

## Documentation

**Configuration (config.yml):**

```yaml
---
#Height limit (by default ops have limitheight.bypass permission set and they can bypass the limit)
height-limit: 64
#Show message on limit reached
show-message: true
#Show plugin prefix on message
show-prefix: true
#Message
message: "&cYou can't build over the height of {LIMIT} blocks!"
#World list where limit is disabled
#For example:
#disabled-in-worlds:
# - world
# - world2
disabled-in-worlds: []
...
```

**Permissions:**

- <dd><i><b>limitheight.*</b> - LimitHeight permissions tree.</i></dd>
- <dd><i><b>limitheight.bypass</b> - Let players bypass the height limit.</i></dd>
