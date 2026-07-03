@extends('layouts.landing-page')

@section('title', 'Marathon System | Produce a Value')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/ticketing.css') }}">
@endpush

@section('content')
    <main class="ticketing-page">
        <section class="section hero">
            <div class="container">
                <p class="eyebrow">Attenzione ASD, organizzatori di maratone, trail e corse</p>
                <h2>Come aumentare le iscrizioni della tua maratona <em>senza spendere di più in pubblicità</em>, pagando fino al 60% in meno di commissioni</h2>
                <p class="subheadline">
                    Marathon System by Produce a Value è una piattaforma di iscrizione <strong>custom</strong> per maratone,
                    corse e trail che gestisce sito, checkout, pagamenti, ticket PDF, email automatiche, dati partecipanti,
                    gruppi, dashboard admin e tracking pubblicitario da <strong>un unico sistema proprietario</strong>.
                </p>
                <div class="cta-group">
                    <a href="#form" class="btn">Richiedi il tuo sito demo gratuito</a>
                    <p class="microcopy top-margin-mid">Compili il modulo, prenoti una call gratuita e ti mostriamo se il tuo evento è adatto al sistema. Nessun pagamento richiesto.</p>
                </div>
                <div class="proof-chips">
                    <div class="chip"><strong>Riduzione ore di lavoro</strong>-70% già nel primo anno</div>
                    <div class="chip"><strong>Oltre 5x iscritti</strong>nello stesso periodo</div>
                    <div class="chip"><strong>Commissioni ridotte</strong>da €2,15 a €0,67 per biglietto</div>
                    <div class="chip"><strong>Sistema custom</strong>Laravel custom + pagamenti integrati</div>
                </div>
            </div>
        </section>

        <section class="section section-alt">
            <div class="container">
                <p class="lead-text">
                    Se organizzi una maratona, una corsa o un trail, probabilmente non hai bisogno che qualcuno ti spieghi
                    quanto può diventare caotica la gestione delle iscrizioni.
                </p>
                <p class="lead-text"><strong>Lo sai già. Lo vivi ogni anno.</strong></p>
                <p class="lead-text">
                    Apri le iscrizioni e, invece di vedere un flusso ordinato di persone che si registrano, pagano e ricevono
                    il biglietto in automatico, inizi a ricevere messaggi del tipo:
                    <br><em>“Mi confermi che sono iscritto?”</em>
                    <br><em>“Posso cambiare percorso?”</em>
                    <br><em>“Ho fatto il bonifico, ti mando screenshot.”</em>
                    <br><em>“Dove trovo il biglietto?”</em>
                    <br><em>“La mail non mi è arrivata.”</em>
                </p>
                <p class="lead-text">
                    Nel frattempo tu o i volontari finite a controllare Excel, bonifici, screenshot WhatsApp, ricevute,
                    dati mancanti, codici fiscali, taglie maglia, gruppi, iscritti doppi, pagamenti non riconciliati e
                    richieste ripetute.
                </p>
                <div class="highlight-box">
                    <p>La cosa assurda è questa: molte di queste richieste non sono colpa degli iscritti. Sono il sintomo di un sistema che non sta facendo il suo lavoro.</p>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <h2>Il costo reale del sistema sbagliato</h2>
                <p>
                    Un sistema di iscrizione fatto male non ti costa solo “un po’ di tempo”. Ti costa iscrizioni, margine,
                    reputazione e serenità nei mesi in cui dovresti concentrarti sull’evento.
                </p>
                <div class="pain-grid top-margin-large">
                    @foreach ([
                        ['Commissioni altissime', 'Ogni biglietto venduto lascia soldi alla piattaforma di iscrizione invece che all’evento.'],
                        ['Checkout confusionario', 'Una parte delle persone abbandona prima di completare l’iscrizione. Non ti scrive: chiude la pagina e basta.'],
                        ['Un solo metodo di pagamento', 'Chi non si fida, non ha carta o preferisce PayPal/bonifico non può far altro che non iscriversi.'],
                        ['Excel e WhatsApp', 'Il database diventa fragile, disperso e facile da sporcare. E quando cresci, ti ritrovi nel caos più totale.'],
                        ['Gruppi gestiti a mano', 'Famiglie, società sportive e gruppi numerosi diventano un incubo operativo.'],
                        ['Ticket non automatici', 'L’iscritto perde il biglietto, non lo trova, chiede conferme. Tu perdi decine di ore del tuo tempo. Ogni anno.'],
                        ['Admin poco chiaro', 'Per ogni modifica devi chiamare lo sviluppatore. Aspettare. E pagare.'],
                        ['Tracking assente', 'Non sai quali campagne, canali o messaggi stiano davvero portando iscritti.'],
                    ] as [$title, $copy])
                        <article class="pain-card">
                            <h4>{{ $title }}</h4>
                            <p>{{ $copy }}</p>
                        </article>
                    @endforeach
                </div>
                <p class="center-callout">
                    <strong>Ogni domanda manuale che ricevi è un segnale.</strong><br>
                    Non un fastidio isolato. Un segnale che il tuo sistema attuale non sta lavorando come dovrebbe.
                </p>
            </div>
        </section>

        <section class="section section-alt">
            <div class="container">
                <h2>Le tre trappole in cui cadono quasi tutti gli organizzatori</h2>
                <ul class="solution-list">
                    <li>
                        <h4>1. Piattaforme chiuse</h4>
                        <p>Estetica standard. Personalizzazione limitata. Commissioni che fanno venire il mal di mare. Nessuna proprietà del sistema. Logiche non sempre adatte al tuo evento. Dipendenza da assistenze lente o impersonali.</p>
                    </li>
                    <li>
                        <h4>2. WooCommerce, plugin e WordPress adattati</h4>
                        <p>WooCommerce è nato per vendere prodotti. Non per gestire iscrizioni complesse, biglietti, percorsi o dati assicurativi.</p>
                    </li>
                    <li>
                        <h4>3. Sito vetrina + gestione manuale</h4>
                        <p>Un sito che presenta l’evento, una pagina “iscriviti”, un sistema esterno, qualche pagamento a mano e tanta buona volontà. Il problema è che la buona volontà, quando i numeri crescono, non basta più.</p>
                    </li>
                </ul>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <p class="eyebrow">La nuova categoria</p>
                <h2 class="mechanism-statement">Non costruiamo siti web. <em>Costruiamo sistemi proprietari di iscrizione per maratone.</em></h2>
                <p>
                    Marathon System by Produce a Value non è un sito generico. È una piattaforma di iscrizione
                    <strong>custom costruita intorno alle necessità reali</strong> di una maratona, una corsa o un trail.
                </p>
                <p>
                    Pagina iscrizione, form partecipante, percorsi, tipologie di biglietto, dati obbligatori per assicurazione,
                    taglie maglia, iscrizioni di gruppo, pagamento multiplo, ticket PDF automatici, codici univoci, email
                    automatiche, dashboard admin, filtri, export CSV, upload gruppi, coupon, tracking Meta, TikTok e Google
                    Analytics, server VPS performante, assistenza annuale.
                </p>
                <div class="highlight-box">
                    <p>La differenza è semplice: una piattaforma standard ti chiede di adattare il tuo evento al suo software.<br>Marathon System adatta il software al tuo evento.</p>
                </div>
            </div>
        </section>

        <section class="section section-alt">
            <div class="container table-wrap">
                <h2 class="text-center">Marathon System vs. le alternative</h2>
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th>Cosa ti serve davvero</th>
                            <th>Piattaforme chiuse / WooCommerce</th>
                            <th class="col-us">Marathon System</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([
                            ['Flusso iscrizione su misura', 'Limitato o forzato da plugin', 'Costruito intorno al tuo evento'],
                            ['Estetica coerente col brand', 'Standard o poco personalizzabile', 'Completamente personalizzabile'],
                            ['Commissioni basse', 'Spesso alte o con sovrapprezzi', 'Integrazione diretta provider'],
                            ['Multi-ticket e gruppi', 'Spesso macchinoso', 'Acquisto multiplo in unica transazione'],
                            ['Dati obbligatori specifici', 'Campi custom spesso fragili', 'Form progettato sui dati reali'],
                            ['Bonifico/contanti centralizzati', 'Gestiti spesso fuori sistema', 'Tracciabili nel portale admin'],
                            ['Ticket PDF e QR', 'Dipende da plugin/licenze', 'Integrati nel flusso nativo'],
                            ['Modifica dati iscritti', 'Spesso serve supporto tecnico', 'Admin su misura per segreteria'],
                            ['Export CSV', 'Non sempre pulito', 'Esportazione diretta e filtrata'],
                            ['Tracking ads', 'Spesso incompleto', 'Eventi standard e personalizzati'],
                            ['Performance', 'Dipende da hosting/plugin', 'VPS e cache per carichi elevati'],
                            ['Supporto', 'Ticket impersonali o dev esterno', 'Assistenza annuale dedicata'],
                        ] as [$need, $other, $us])
                            <tr>
                                <td>{{ $need }}</td>
                                <td>{{ $other }}</td>
                                <td class="col-us">{{ $us }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <p class="eyebrow">Proof reale, non teoria</p>
                <h2>Abbiamo già costruito questo sistema per un evento reale</h2>
                <p>Non mockup. Non “possiamo farlo”. Un sistema reale, usato da un evento reale, con iscrizioni reali, pagamenti reali e gestione admin reale.</p>

                <article class="case-study">
                    <div class="case-study-header">
                        <span class="case-study-tag">Caso studio</span>
                        <h3>Francigena Tuscany Marathon</h3>
                    </div>
                    <div class="metrics">
                        <div class="metric"><span class="metric-number">5x</span><span class="metric-label">iscritti nello stesso periodo</span></div>
                        <div class="metric"><span class="metric-number">€0,67</span><span class="metric-label">commissione media per biglietto</span></div>
                        <div class="metric"><span class="metric-number">€2,15</span><span class="metric-label">commissione precedente</span></div>
                        <div class="metric"><span class="metric-number">+86%</span><span class="metric-label">velocità sito aumentata</span></div>
                    </div>
                </article>

                <blockquote>
                    “Tommaso e i ragazzi di Produce a Value hanno fatto un lavoro impeccabile: il nostro nuovo sito ha tutto ciò che serve, dalla A alla Z, costruito rispettando ogni nostra singola richiesta.”
                    <cite>— Roberto Cervelli, Responsabile Tecnico, Francigena Tuscany Marathon</cite>
                </blockquote>

                <blockquote>
                    “La nostra priorità era un’assistenza competente, veloce e sempre reperibile. Tommaso e i suoi ragazzi risolvono ogni minimo problema in massimo 20 minuti. Qualcosa di inimmaginabile finché non lo si prova.”
                    <cite>— Andrea Gentile, Vice-presidente, Francigena Tuscany Marathon</cite>
                </blockquote>
            </div>
        </section>

        <section class="section section-alt">
            <div class="container">
                <h2>Cosa cambia concretamente per te</h2>
                <ol class="benefits-list top-margin-xl">
                    @foreach ([
                        ['Processo più semplice, più iscrizioni', 'Quando il checkout è chiaro, veloce, mobile-first e costruito intorno all’evento, l’iscritto non deve “capire come fare”. Sceglie il percorso. Inserisce i dati. Paga. Riceve il ticket. Fine.'],
                        ['Commmissioni drasticamente più basse, niente piattaforme che aggiungono sovrapprezzi', 'Nel caso Francigena, la commissione media per biglietto è passata da €2,15 a €0,67. Su 1.500 iscrizioni totali, il risparmio annuo è di 2220€'],
                        ['Meno assistenza manuale, il sistema lavora al posto tuo', 'Ticket PDF automatici, email automatiche, codici univoci, portale admin, ricerca iscritti, export CSV e gestione gruppi. Tutto questo ti fa risparmiare centinaia di ore di lavoro ogni anno.'],
                        ['Dati più puliti per organizzare meglio il giorno evento', 'Codice fiscale, percorso, taglia, assicurazione, gruppo, metodo di pagamento, stato iscrizione e ticket nello stesso sistema.'],
                        ['Niente chiamate allo sviluppatore per ogni singola modifica', 'Puoi cercare un iscritto, controllare un pagamento, modificare un dato, scaricare un biglietto o esportare un CSV. Tutto in autonomia, senza necessità di contattare lo sviluppatore.'],
                        ['Più professionalità davanti a iscritti, sponsor, Comune e associazione', 'Un flusso pulito, veloce e personalizzato comunica serietà, professionalità e sicurezza.'],
                    ] as [$title, $copy])
                        <li>
                            <h4>{{ $title }}</h4>
                            <p>{{ $copy }}</p>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <h2>Ecco cosa scoprirai nel sistema</h2>
                <ul class="fascinations">
                    @foreach ([
                        'Il motivo per cui ogni domanda manuale che ricevi è il sintomo di un sistema che non sta facendo il suo lavoro.',
                        'Come ridurre la frizione del checkout senza aumentare il budget pubblicitario.',
                        'Perché WooCommerce è spesso la scelta sbagliata per maratone, trail e corse con percorsi, gruppi, ticket e dati obbligatori.',
                        'Come permettere a famiglie, società sportive e gruppi di acquistare più ticket in un’unica transazione.',
                        'Come centralizzare bonifico, contanti, carta e PayPal senza perdere il controllo degli iscritti.',
                        'Come evitare di rincorrere persone per codice fiscale, taglia maglia, percorso o dati assicurativi mancanti.',
                        'Come trovare in pochi secondi il singolo iscritto che ti sta scrivendo su WhatsApp.',
                        'Come trasformare la tua pagina iscrizione da “modulo adattato” a flusso progettato per convertire.',
                        'Come sapere quali campagne, canali o promozioni stanno generando davvero iscrizioni.',
                        'Come arrivare al giorno evento con un database pulito invece che con file, screenshot e pagamenti sparsi.',
                    ] as $item)
                        <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </section>

        <section class="section section-alt">
            <div class="container">
                <p class="eyebrow">L’offerta</p>
                <h2>Cosa ricevi con Marathon System</h2>
                <p>Quando un evento qualificato lavora con Produce a Value, riceve un sistema completo di iscrizione, pagamento e gestione partecipanti.</p>

                <ol class="offer-list">
                    @foreach ([
                        ['Analisi del flusso iscrizione attuale', 'Guardiamo il sistema che usi oggi, dove perde iscritti, dove crea assistenza manuale e dove ti sta facendo pagare costi inutili.'],
                        ['Progettazione UX del checkout', 'Disegniamo il flusso di iscrizione in modo che l’utente sappia sempre cosa fare, cosa sta pagando e cosa succede dopo.'],
                        ['Progettazione UI del sito', 'Creiamo un’interfaccia coerente con la tua manifestazione, non un template anonimo uguale a tutti gli altri.'],
                        ['Sviluppo sito / landing iscrizione', 'Costruiamo la pagina principale del sistema, pronta per ricevere traffico organico, social, ads, newsletter e link da sponsor.'],
                        ['Sistema ticketing custom', 'Percorsi, biglietti, ticket multipli, gruppi, codici univoci, QR/barcode e logica di iscrizione configurati intorno al tuo evento.'],
                        ['Portale admin personalizzato', 'Dashboard per gestire iscritti, pagamenti, dati, gruppi, filtri, export, ticket e operazioni quotidiane.'],
                        ['Integrazione pagamenti', 'Stripe, PayPal, bonifico, contanti e metodi aggiuntivi se necessari.'],
                        ['Ticket PDF + email automatiche', 'L’iscritto riceve automaticamente il biglietto dopo il pagamento, con una copia sempre recuperabile dalla propria email.'],
                        ['Export CSV + filtri', 'Dati esportabili, leggibili e gestibili senza licenze particolari e senza dover rovistare nel database.'],
                        ['Tracking ads + analytics', 'Setup degli eventi fondamentali per capire da dove arrivano traffico, iscrizioni e pagamenti.'],
                        ['Setup server VPS', 'Infrastruttura performante e controllata, progettata per reggere picchi di traffico e iscrizione.'],
                        ['Formazione admin', 'Materiali e spiegazioni per usare il portale in autonomia.'],
                        ['Supporto lancio', 'Supporto nei momenti più delicati, soprattutto intorno all’apertura iscrizioni.'],
                        ['Assistenza annuale', 'Un riferimento tecnico durante l’anno per non ritrovarti da solo quando qualcosa deve essere aggiornato, verificato o corretto.'],
                    ] as [$title, $copy])
                        <li>
                            <span>{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <div>
                                <h4>{{ $title }}</h4>
                                <p>{{ $copy }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>

                <h3 class="top-margin">E in più, 3 bonus inclusi</h3>
                <div class="bonus-grid top-margin-xl">
                    @foreach ([
                        ['Demo gratuita del nuovo sito', 'Prima di investire, vuoi vedere se siamo davvero capaci di costruire qualcosa di concreto. Se il tuo evento è qualificato, ti mostriamo una demo funzionante del tuo nuovo sistema direttamente in call.'],
                        ['Demo admin funzionante', 'Ti mostriamo anche come sarebbe gestita la parte interna: iscritti, ticket, dati, ricerca, filtri, export, pagamenti.'],
                        ['Analisi gratuita del flusso attuale', 'Guardiamo il sistema che usi oggi e ti mostriamo dove può perdere iscritti, creare richieste manuali o generare costi inutili.'],
                    ] as [$title, $copy])
                        <article class="bonus-card">
                            <h4>{{ $title }}</h4>
                            <p>{{ $copy }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <h2 class="text-center">Il valore reale di quello che ricevi</h2>
                <p class="text-center max-center">Ecco quanto costerebbe costruire ogni componente separatamente, se dovessi pagarlo al normale prezzo di mercato.</p>

                <table class="value-table">
                    @foreach ([
                        ['Analisi flusso iscrizione attuale', '€150'],
                        ['Progettazione UX checkout', '€470'],
                        ['Progettazione UI sito', '€750'],
                        ['Sviluppo sito / landing', '€1.100'],
                        ['Sistema ticketing', '€550'],
                        ['Admin panel', '€240'],
                        ['Integrazione pagamenti', '€600'],
                        ['Ticket PDF + email automatiche', '€360'],
                        ['Export CSV + filtri', '€130'],
                        ['Tracking ads + analytics', '€280'],
                        ['Setup server VPS', '€420'],
                        ['Formazione admin', '€250'],
                        ['Supporto lancio', '€150'],
                        ['Assistenza annuale', '€1.800'],
                    ] as [$component, $value])
                        <tr>
                            <td>{{ $component }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                    <tr class="total">
                        <td>Valore totale primo anno</td>
                        <td>€7.250</td>
                    </tr>
                </table>
            </div>
        </section>

        <section class="section section-surface">
            <div class="container stack-3xl">
                <div class="price-reveal">
                    <p class="eyebrow">Il tuo investimento</p>
                    <div class="price-big">€900 <span>+ €700/anno</span></div>
                    <p class="price-note">Setup una tantum + mantenimento, assistenza e infrastruttura annuale.<br>Il prezzo di partenza è circa il <strong>22% del valore percepito</strong> del sistema.</p>
                    <p class="price-note">Pagamento <strong>50/50</strong>: 50% all’avvio, 50% prima del go-live.<br>Per la demo gratuita non serve nessun acconto.</p>
                    <a href="#form" class="btn">Richiedi la demo gratuita</a>
                </div>

              <div class="stack-large">
                <h3 class="text-center">Il conto che ti convince</h3>
                <p class="text-center max-center top-margin-large">Se oggi paghi una commissione media di €2,15 per biglietto e con un’integrazione diretta scendi a €0,67, il risparmio è di <strong>€1,48 per iscrizione</strong>.</p>
                <table class="math-table">
                    <thead>
                        <tr>
                            <th>Iscritti annui</th>
                            <th>Risparmio stimato sulle commissioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>500</td><td class="savings">€740</td></tr>
                        <tr><td>1.000</td><td class="savings">€1.480</td></tr>
                        <tr><td>1.500</td><td class="savings">€2.220</td></tr>
                        <tr><td>2.000</td><td class="savings">€2.960</td></tr>
                    </tbody>
                </table>
                <p class="text-center max-center small-copy top-margin-large">E questo calcola <strong>solo le commissioni</strong>. Non calcola iscrizioni recuperate, ore di segreteria risparmiate, meno errori manuali, meno ticket smarriti, meno bonifici da riconciliare.</p>
              </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <h2>Prima vedi la demo. Poi decidi.</h2>
                <p>Sappiamo che affidare il sistema iscrizioni della tua maratona a qualcuno è una decisione delicata. Per questo riduciamo il rischio in più modi.</p>
                <div class="guarantee-box top-margin-large">
                    <h3>La nostra inversione del rischio</h3>
                    <ul class="guarantee-list">
                        <li><strong>Demo funzionante prima dell’acconto</strong>: se il tuo evento è qualificato, ti mostriamo una demo concreta del sistema prima che tu debba pagare.</li>
                        <li><strong>Pagamento 50/50</strong>: non paghi tutto in anticipo. Il saldo viene versato prima del go-live.</li>
                        <li><strong>Ambiente staging prima della pubblicazione</strong>: puoi vedere e testare il sistema in un ambiente separato.</li>
                        <li><strong>Test completo prima del lancio</strong>: controlliamo flusso iscrizione, pagamenti, email, ticket, admin, export e funzioni principali.</li>
                        <li><strong>Garanzia consegna</strong>: se il sistema non rispetta specifiche e tempistiche stabilite per causa nostra, ti rimborsiamo il 100% dell’importo pagato.</li>
                        <li><strong>Supporto prioritario nei giorni critici</strong>: nei momenti più delicati sai a chi rivolgerti.</li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section section-alt">
            <div class="container">
                <h2 class="text-center">Perché agire ora</h2>
                <p>Ogni sistema viene personalizzato intorno al singolo evento. Questo richiede progettazione, sviluppo, test, configurazione, revisione e go-live.</p>
                <div class="scarcity-alert">
                    <p>Accettiamo <strong>massimo 3 nuovi progetti ticketing al mese</strong>.<br>Se la tua apertura iscrizioni è fra meno di 4 settimane, potremmo non riuscire a seguirti per questa edizione.</p>
                </div>
                <p class="text-center max-center">Aspettare troppo significa spesso: riaprire con il vecchio sistema, pagare ancora commissioni alte, gestire ancora bonifici, Excel e WhatsApp, arrivare tardi al lancio ads, perdere lo slot di sviluppo.</p>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <h2 class="text-center">Per chi è. Per chi non è.</h2>
                <div class="qual-grid">
                    <div class="qual-box yes">
                        <h4>Marathon System è per te se:</h4>
                        <ul>
                            <li>Organizzi una maratona, corsa, trail o evento sportivo</li>
                            <li>Vendi almeno 100 biglietti l’anno</li>
                            <li>Hai già un evento validato</li>
                            <li>Vuoi ridurre caos operativo, commissioni e assistenza manuale</li>
                            <li>Vuoi una piattaforma più professionale prima della prossima edizione</li>
                            <li>Vuoi gestire iscritti e dati senza chiamare lo sviluppatore per ogni cosa</li>
                            <li>Hai almeno 4 settimane prima dell’apertura iscrizioni</li>
                        </ul>
                    </div>
                    <div class="qual-box no">
                        <h4>Non è per te se:</h4>
                        <ul>
                            <li>Vuoi solo “un sito economico”</li>
                            <li>Vendi meno di 100 biglietti l’anno</li>
                            <li>Vuoi assistenza gratuita infinita</li>
                            <li>Vuoi modifiche illimitate fuori scope</li>
                            <li>Vuoi gestire campagne ads incluse nel prezzo</li>
                            <li>Hai bisogno di andare live domani</li>
                            <li>Non hai un referente chiaro per approvare materiali e decisioni</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="section form-section" id="form">
            <div class="container">
                <h2 class="text-center">Richiedi il tuo sito demo gratuito</h2>
                <p class="text-center max-center">Il processo è semplice. Compili il modulo. Prenoti una call gratuita. Se il tuo evento è qualificato, ti mostriamo una demo funzionante del tuo nuovo sistema.</p>

                @if ($errors->any())
                    <div class="form-error qualification-form">
                        <strong>Controlla i campi</strong>
                        <p>Ci sono dati mancanti o non validi.</p>
                    </div>
                @endif

                <form class="qualification-form" action="{{ route('services.ticketing-custom.store') }}" method="post">
                    @csrf
                    <div class="form-honeypot" aria-hidden="true">
                        <label>Company website
                            <input type="text" name="company_website" tabindex="-1" autocomplete="off">
                        </label>
                    </div>

                    <div class="form-row">
                        <label for="name">Nome e cognome</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Mario Rossi">
                    </div>
                    <div class="form-row">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="mario@evento.it">
                    </div>
                    <div class="form-row">
                        <label for="event_name">Nome evento</label>
                        <input type="text" id="event_name" name="event_name" value="{{ old('event_name') }}" required placeholder="Maratona di Firenze">
                    </div>
                    <div class="form-row">
                        <label for="annual_tickets">Numero iscritti ultima edizione</label>
                        <select id="annual_tickets" name="annual_tickets" required>
                            <option value="">Seleziona...</option>
                            @foreach (['100-500', '500-1000', '1000+'] as $option)
                                <option value="{{ $option }}" @selected(old('annual_tickets') === $option)>{{ str_replace('-', ' – ', $option) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row">
                        <label for="launch_timing">Data apertura iscrizioni prossima edizione</label>
                        <input type="date" id="launch_timing" name="launch_timing" value="{{ old('launch_timing') }}" required>
                    </div>
                    <div class="form-row">
                        <label for="message">Principale problema attuale</label>
                        <textarea id="message" name="message" placeholder="Descrivi brevemente il tuo sistema attuale e cosa non funziona...">{{ old('message') }}</textarea>
                    </div>
                    <div class="form-row text-center">
                        <button type="submit" class="btn">Richiedi il tuo sito demo gratuito</button>
                    </div>
                    <p class="text-center top-margin-xl">Nessun acconto per vedere la demo. Accettiamo massimo 3 nuovi progetti ticketing al mese.</p>
                </form>
            </div>
        </section>

        <section class="section section-alt">
            <div class="container faq-container">
                <h2 class="text-center">Domande frequenti</h2>
                @foreach ([
                    ['“E se il sito non funziona?”', 'Prima del go-live il sistema viene testato su checkout, pagamento, email, ticket, admin, export e funzioni principali. In più puoi vedere una demo funzionante prima ancora di versare l’acconto.'],
                    ['“E se i pagamenti non arrivano?”', 'L’integrazione avviene direttamente con provider di pagamento riconosciuti come Stripe e PayPal. Prima del go-live vengono eseguiti test sul flusso di pagamento.'],
                    ['“E se non so usare il portale admin?”', 'Il portale viene progettato per essere usabile dalla segreteria evento, non da programmatori. Includiamo formazione admin e assistenza annuale.'],
                    ['“Perché costa così poco rispetto a un sistema custom classico?”', 'Perché non ripartiamo da zero. Abbiamo già costruito e testato una base proprietaria su un evento reale.'],
                    ['“Il prezzo è fisso?”', 'Il sistema parte da €900 di setup + €700/anno. Funzioni altamente personalizzate o richieste fuori scope vengono preventivate separatamente prima dell’avvio.'],
                    ['“Quanto tempo serve?”', 'Per progetti standard, normalmente 25-30 giorni. Per progetti molto personalizzati, fino a 75 giorni.'],
                ] as [$question, $answer])
                    <div class="ticket-faq-item">
                        <h4>{{ $question }}</h4>
                        <p>{{ $answer }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="section ps-section">
            <div class="container">
                <p class="ps-text">P.S. Puoi continuare a riaprire le iscrizioni con lo stesso sistema dell’anno scorso, sperando che questa volta ci siano meno messaggi, meno bonifici da controllare, meno dati mancanti, meno ticket persi e meno commissioni inutili.</p>
                <p class="ps-text">Oppure puoi vedere in una call gratuita come sarebbe una piattaforma costruita davvero intorno alla tua maratona, con una demo funzionante prima ancora di versare un acconto.</p>
                <div class="text-center">
                    <a href="#form" class="btn">Richiedi il tuo sito demo gratuito</a>
                </div>
            </div>
        </section>
    </main>
@endsection
