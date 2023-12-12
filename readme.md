# Silverstripe Softgarden

## Install

```
composer require brandcom/silverstripe-softgarden:dev-ss4
```

## Implementierung der API

Im Backend von Softgarden kann man für jedes Unternehmen einen API Key generieren.
Schritt 1: Channel ID ermitteln https://dev.softgarden.de/frontend-v3/verfugbare-kanale/
Schritt 2: folgende Variablen in der .env eintragen:

#Softgarden Api

SOFTGARDEN_API_KEY='ClientId'

SOFTGARDEN_API_Password='' # Kann leer bleiben, da basic auth

SOFTGARDEN_API_CHANNEL_ID='channelID'

## API Fetch auslösen -WIP
Momentan unter der URL "BASEURL/dev/tasks/JobImportBuildTask"

## Im Projekt

Es muss eine Seite mit dem Namen "Jobdetails" vom Typ "Softgarden Job Detail Page" eingerichtet werden. In den Einstellungen den Haken bei Sichtbarkeit (Menü und Suche) entfernen.

## Jobs auf Seite anzeigen

Um vorhandene Jobs anzuzeigen, setzt man an beliebiger Stelle das BaseElement "Softgarden Job Übersicht" aus. Hier kann noch eine Überschrift gepflegt werden.