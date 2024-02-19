# Silverstripe Softgarden

## Install

```
composer require brandcom/silverstripe-softgarden:dev-ss4
```

## Implementierung


- Vorbereitung: 
    - BaseElement.php Datei im Projekt unter app/src/BaseElements vorhanden? (Sonst aus Silverstripe Starter kopieren. Grundsätzlich muss im Projekt Silverstripe-Elemental installiert sein)
    - API Key bei Softgarden ermitteln
    - ChannelID ermitteln (Über Fetch Request)
    - .env im Projekt mit Variablen befüllen
- Plugin installieren: composer require brandcom/silverstripe-softgarden:dev-ss4
- Dev build flush
- Im Admin Bereich sollten sich nun zwei neue Modal Admins befinden. (Job-Import & Job-Benefits)
- Nun im Modal Admin „Job-Benefits“ ein Default Benefit hinterlegen mit Name „standard“ und Icon welches sich als Standard Icon eignet
- In das Modal Admin Job-Import wechseln und die Jobs manuell importieren über Button „Stellenanzeigen IMORTIEREN“ (Wenn keine Jobs erscheinen, prüfen ob in Softgarden Stellenausschreibungen vorhanden sind)
- Um die Jobs als Übersicht anzuzeigen, an beliebiger Stelle das BaseElement  „Softgarden Job Übersicht“ einsetzen und eine Headline vergeben.
- Eine neue Seite vom Typ „Softgarden Job Detail Page“ anlegen. Die Seite muss „Jobdetails“ heißen.
- Bei den Einstellungen der Jobdetails Seite den Haken für Menü & Suche anzeigen entfernen.
- Es sollte ein Header verfügbar sein. Darüber kann ein Standard Bild für den Job hinterlegt werden.
-Im Header-Image-Textfeld folgendes über den Tiny HTML Editor hinterlegen:

```
    <div class="container headerimage_text text-white">
        <h1><span id="softgarden__job_name_label" class="h1">Jobbezeichnung</span></h1>
        <h2><span id="softgarden__job_infos_label" class="h4">Infos:</span></h2>
    </div>
    
```



## .ENV Variablen

SOFTGARDEN_API_KEY='ClientId'

SOFTGARDEN_API_Password='' # Kann leer bleiben, da basic auth

SOFTGARDEN_API_CHANNEL_ID='channelID'

SOFTGARDEN_AUTO_BUILDTASK_TOKEN='' # Für Cronjobs - hier kann ein token hinterlegt werden. Beispiel: BaseUrl/jobdetails/jobAutoImport?token={TOKEN}

## API Fetch auslösen -WIP
Momentan unter der URL "BASEURL/dev/tasks/JobImportBuildTask"

# Im Projekt Backend


## Jobs auf Seite anzeigen

Um vorhandene Jobs anzuzeigen, setzt man an beliebiger Stelle das BaseElement "Softgarden Job Übersicht" ein. Hier kann noch eine Überschrift gepflegt werden.

## Jobs auf Detailseite anzeigen

Es muss eine Seite mit dem Namen "Jobdetails" vom Typ "Softgarden Job Detail Page" eingerichtet werden. In den Einstellungen den Haken bei Sichtbarkeit (Menü und Suche) entfernen.
Auf der Jobdetails Seite unter dem Punkt Header ein geeignetes Bild wählen. Das Bild muss zu jedem Beruf passen, da hier kein individuelles Bild ausgespielt wird.

