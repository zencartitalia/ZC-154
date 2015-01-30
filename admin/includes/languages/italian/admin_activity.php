<?php
/**
 * @package admin
 * @copyright Copyright 2015 Zen Wired Development Team - www.zenwired.com
 * @copyright Portions Copyright 2003-2015 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version Id: admin_activity.php 2015-01-05 12:43 Author: Paolo De Dionigi aka Spike00 Modified in v1.5.4
*/

define('HEADING_TITLE', 'Gestione Log Attivit&agrave; Amministratore');
define('HEADING_SUB1', 'Consultare o Esportare Log');
define('HEADING_SUB2', 'Svuotare Cronologia Log');
define('TEXT_ACTIVITY_EXPORT_FORMAT', 'Formato File Esportazione:');
define('TEXT_ACTIVITY_EXPORT_FILENAME', 'Nome File Esportazione:');
define('TEXT_ACTIVITY_EXPORT_SAVETOFILE','Salvare su file nel server? (altrimenti verranno visualizzati direttamente in questa pagina)');
define('TEXT_ACTIVITY_EXPORT_DEST','Destinazione: ');
define('TEXT_PROCESSED', ' Elaborato.');
define('SUCCESS_EXPORT_ADMIN_ACTIVITY_LOG', 'Esportazione completata. ');
define('FAILURE_EXPORT_ADMIN_ACTIVITY_LOG', 'ATTENZIONE: Esportazione non riuscita. Non &egrave; stato possibile scrivere nel file ');

define('TEXT_INSTRUCTIONS','<u>ISTRUZIONI</u><br />Usare questa pagina per esportare l\'Attivit&agrave; degli Admin di Zen Cart&reg; in un file CSV per l\'archiviazione.<br />&Egrave; consigliabile salvare questi dati per l\'uso in indagini per frode nel caso in cui il sito sia stato compromesso. Si tratta di un requisito per la conformit&agrave; PCI.<br />
<ol><li>Scegliere se visualizzare o esportare in un file.<li>Inserire un nome file.<li>Premere Salva per procedere.<li>Scegliere se salvare o aprire il file, a seconda di cosa propone la finestra del browser.</ol>');

define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>Vuota Tabella attivit&agrave; di Admin dal database<br />ATTENZIONE: effettuare backup del database prima di procedere!</strong><br />Activity Log &egrave; un metodo che registra le attivit&agrave; dell\'Admin. <br />Data la sua natura pu&ograve; diventare molto grande in poco tempo e deve essere svuotato di tanto in tanto.<br />Avvertimenti verranno dati a 50,000 registrazioni oppure dopo 60 giorni, a seconda di cosa avvenga prima.<br /><span class="alert">NOTA: Per la Conformit&agrave; PCI, si &egrave; tenuti a mantenere l\'archivio dell\'admin activity log per 12 mesi.<br />Si consiglia di archiviare i log scegliendo di ESPORTARE COME CSV e premere Salva, qui sopra, *PRIMA* di svuotare la tabella dei log dati.</span>');
define('TEXT_ADMIN_LOG_PLEASE_CONFIRM_ERASE', '<strong><span class="alert">ATTENZIONE!: Si stanno per CANCELLARE dal database record *importanti* per tracciare visite ed effettuare verifiche.</span></strong><br />Si deve PRIMA confermare di avere un BACKUP integro e completo del database e poi procedere.<br />Procedendo si conferma di aver accettato di cancellare queste informazioni e di aver preso coscienza delle proprie responsabilit&agrave; giuridiche in merito a questi dati.<br /><br />Conosco le mie responsabilit&agrave; e voglio procedere con la rimozione premendo Resetta:<br />');
define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', 'Cancellazione <strong>Completata</strong> del Log Attivit&agrave; Amministratore');
define('TEXT_NO_RECORDS_FOUND', 'Nessun risultato trovato con il filtro che hai scelto.');

define('TEXT_EXPORTFORMAT0', 'Esporta come HTML (ideale per la visualizzazione su schermo)');
define('TEXT_EXPORTFORMAT1', 'Esporta come CSV (ideale per importazione in excel o simile)');
define('TEXT_EXPORTFORMAT2', 'Esporta come TXT');
define('TEXT_EXPORTFORMAT3', 'Esporta come XML');

define('TEXT_ACTIVITY_EXPORT_FILTER', 'Quali log vuoi vedere?');
define('TEXT_EXPORTFILTER0', 'Tutti i log, indipendentemente dal livello di gravità.');
define('TEXT_EXPORTFILTER1', 'INFO - Informazioni generiche');
define('TEXT_EXPORTFILTER2', 'NOTICE - Informazioni di maggiore interesse, dovrebbero essere controllate periodicamente');
define('TEXT_EXPORTFILTER3', 'WARNING - Attività che dovrebbero essere controllate quotidianamente');
define('TEXT_EXPORTFILTER4', 'Sia NOTICE sia WARNING (consigliata).');

define('TEXT_INTERPRETING_LOG_DATA', '<p><strong>Interpretazione dei LOG</strong><ul>
<li><strong>Gravità</strong> - Gli standard relativi alle attività di LOG, descrivono i livelli di gravità nel seguente modo:<ul>
<li><strong>INFO</strong> è relativo ad attività generiche. Può contenere informazioni interessanti come dettagli inutili.</li>
<li><strong>NOTICE</strong> è relativo ad attività che richiedo privilegi più elevati, può includere cose come la creazione di un nuovo amministratore o l\'aggiunta di un nuovo modulo di pagamento. Inoltre viene attivato ogni volta che i dati trasmessi in una pagina presentano un contenuto potenzialmente pericoloso, come tag script o iframes embedded, dove del contenuto dannoso potrebbe essere aggiunto alle pagine del sito da impiegati scontenti o da intrusi. Questi log dovrebbero essere controllati regolarmente alla ricerca di anomalie come attività non autorizzate.</li>
<li><strong>WARNING</strong> è assegnato a eventi CRITICI come la rimozione di moduli di pagamento o la cancellazione di amministratori. Questi LOG sono relativi ad attività che potrebbero indicare la presenza di problemi incombenti se non sono controllate rapidamente. Dovrebbero essere controllati frequentemente; si suggerisce di controllarli quotidianamente.</li>
</ul>
<li><strong>admin_user</strong> - Questo mostra il numero di ID amministratore seguito dallo username. Se non loggato, mostra 0.</li>
<li><strong>page_accessed</strong> - Questo indica il nome della pagina visitata, in modo da avere un idea di quale attività stia venendo effettuata.</li>
<li><strong>parameters</strong> - Questo è il resto dell\'URI della pagina visitata, fornisce ulteriori informazioni sul tipo di attività che il visitatore sta compiendo.</li>
<li><strong>flagged</strong> - Se è impostato a 1, indica che dovresti controllare il contenuto registrato nel campo "postdata" per inserimento non autorizzato di script o iframe o altro contenuto potenzialmente pericoloso. Nel campo "attention" potrai visualizzare maggiori informazioni sul tipo di contenuto sospetto che è stato individuato.</li>
<li><strong>attention</strong> - Questo contiene suggerimenti relativi al tipo di attività sospetta presente nel campo postdata se flaggato.</li>
<li><strong>logmessage</strong> - Questo LOG contiene tutti i messaggi registrati dal sistema sulle varie attività, come ad esempio l\'installazione di un qualsiasi modulo.</li>
<li><strong>postdata</strong> - Questo LOG contiene i dati grezzi passati via POST (ad eccezzione di alcuni dati sensibili, che vengono rimossi) per un facile controllo nel caso si sospetti che si sia verificata una attività pericolosa.</li>
</ul></p>');
