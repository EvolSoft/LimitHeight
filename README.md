![start2](https://cloud.githubusercontent.com/assets/10303538/6315586/9463fa5c-ba06-11e4-8f30-ce7d8219c27d.png)

# LimitHeight
A PocketMine-MP plugin to limit the build height

## Category

PocketMine-MP plugins

## Requirements

PocketMine-MP Alpha_1.4 API 1.11.0<br>

**LimitHeight** allows you to limit the build height in your worlds.

**EvolSoft Website:** http://www.evolsoft.tk

**This Plugin uses the New API. You can't install it on old versions of PocketMine.**

With LimitHeight you can limit the build height in worlds (read documentation)

## Documentation

Configuration (config.yml):

```yaml
---
#Height limit (by default ops have limitheight.bypass permission set and they can bypass the limit. If you want to limit the build height also for ops, simply use a permission manager plugin)
height-limit: 250
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

- <dd><i><b>limitheight.*</b> - LimitHeight permissions.</i></dd>
- <dd><i><b>limitheight.bypass</b> - Allows players to bypass the height limit.</i></dd>
