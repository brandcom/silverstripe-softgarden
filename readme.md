# Silverstripe Softgarden

## Install

```
composer require brandcom/silverstripe-softgarden:dev-ss4
oder
composer require brandcom/silverstripe-softgarden:dev-ss5
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
- Um die Jobs als Übersicht anzuzeigen, an beliebiger Stelle das BaseElement „Softgarden Job Übersicht“ einsetzen und eine Headline vergeben.
- Eine neue Seite vom Typ „Softgarden Job Detail Page“ anlegen. Die Seite muss „Jobdetails“ heißen.
- Bei den Einstellungen der Jobdetails Seite den Haken für Menü & Suche anzeigen entfernen.
- Es sollte ein Header verfügbar sein. Darüber kann ein Standard Bild für den Job hinterlegt werden.
  -Im Header-Image-Textfeld folgendes über den Tiny HTML Editor hinterlegen:

```
    <div>
        <h1><span id="softgarden__job_name_label" class="h1">Jobbezeichnung</span></h1>
        <h2><span id="softgarden__job_infos_label" class="h4">Infos:</span></h2>
    </div>

```

## .ENV Variablen

#Softgarden API

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

# NEU

### Benefits limitieren

- Die auf der Detailseite angezeigten Benefits sind nun limitierbar.
- Auf der Jobdetails Page befindet sich hierfür folgendes Eingabefeld "Maximale Anzahl der Benefits".
- Wird nichts eingetragen, werden alle ausgegeben.
- Es wird eine dynamische Überschrift mit der Anzahl der Benefits angezeigt z.B. "DEINE TOP 3 BENEFITS BEI UNS"

# Standort Filter für das Softgarden Job Base Element

- Im Base-Element "Softgarden-Job-Base-Element" kann ein Standortfilter aktiviert werden.
- Es wird extra JS Code benötigt, welcher in das Projekt eingebunden werden muss.

### In App.js

```
import { filter_jobs } from "./js/SoftgardenBaseElementFilter";

...

filter_jobs();

```

### In erstellter Datei SoftgardenBaseElementFilter.js

```

export function filter_jobs() {

    const softgardenBaseElem = document.querySelectorAll(".bc-softgarden__job-base-element");

    if (softgardenBaseElem.length > 0) {
        const filterTriggers = document.querySelectorAll('.bc-softgarden__job-base-element-dropdown-locations');

        filterTriggers.forEach((filterTrigger) => {
            filterTrigger.addEventListener('change', () => {
                const jobElements = document.querySelectorAll(".bc-softgarden__job-base-element-overlay-job");
                    jobElements.forEach((jobElement) => {
                        if (filterTrigger.value === "empty") {
                            jobElement.style.display = "flex";
                        } else {
                            const CityData = jobElement.getAttribute("data-location");
                            if (CityData === filterTrigger.value) {
                                jobElement.style.display = "flex";
                            } else {
                                jobElement.style.display = "none";
                            }
                        }
                    });
                    //* Set all location filter values to selected location
                    const all_location_filter = document.querySelectorAll(".bc-softgarden__job-base-element-dropdown-locations");
                    all_location_filter.forEach((location_filter) => {
                        location_filter.value = filterTrigger.value ;
                    });
            })
        })
    }
}

```

# Sonderfall mehrere API Keys pro Seite

Sollten mehrere API Keys pro Seite vorhanden sein, müssen diese in der .env durchnummeriert werden.

SOFTGARDEN_API_KEY1='KEY1'

SOFTGARDEN_API_KEY2='KEY2'

SOFTGARDEN_API_CHANNEL_ID1='ID1'

SOFTGARDEN_API_CHANNEL_ID2='ID2'
