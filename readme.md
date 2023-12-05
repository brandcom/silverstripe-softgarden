# Silverstripe Softgarden

## Implementierung der API

Im Backend von Softgarden kann man für jedes Unternehmen einen API Key generieren.
Schritt 1: Channel ID ermitteln https://dev.softgarden.de/frontend-v3/verfugbare-kanale/
Schritt 2: folgende Variablen in der .env eintragen:

#Softgarden Api

SOFTGARDEN_API_KEY='ClientId'

SOFTGARDEN_API_Password='' # Kann leer bleiben, da basic auth

SOFTGARDEN_API_CHANNEL_ID='channelID'
