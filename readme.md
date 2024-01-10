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

# Im Projekt Backend


## Jobs auf Seite anzeigen

Um vorhandene Jobs anzuzeigen, setzt man an beliebiger Stelle das BaseElement "Softgarden Job Übersicht" ein. Hier kann noch eine Überschrift gepflegt werden.

## Jobs auf Detailseite anzeigen

Es muss eine Seite mit dem Namen "Jobdetails" vom Typ "Softgarden Job Detail Page" eingerichtet werden. In den Einstellungen den Haken bei Sichtbarkeit (Menü und Suche) entfernen.
Auf der Jobdetails Seite unter dem Punkt Header ein geeignetes Bild wählen. Das Bild muss zu jedem Beruf passen, da hier kein individuelles Bild ausgespielt wird.

Im Header-Image-Textfeld folgendes über den Tiny HTML Editor hinterlegen:

```
    <div class="KLASSE">
        <h1><span id="softgarden__job_name_label" class="h1">Jobbezeichnung</span></h1>
        <h2><span id="softgarden__job_infos_label" class="h4">Infos:</span></h2>
    </div>
    
```


In der composer.json folgendes unter dem Punkt "extra" hinzufügen

 ```

    "expose": [
        "vendor/brandcom/silverstripe-softgarden/client/dist"
    ]

```

Dann den folgenden Terminal-Befehl ausführen

```
    composer vendor-expose

```