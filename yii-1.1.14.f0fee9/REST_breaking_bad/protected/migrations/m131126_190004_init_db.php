<?php

class m131126_190004_init_db extends CDbMigration
{
	public function up()
	{
		$this->createTable('episoden', array(
			'NR_TOTAL' => 'int(11) NOT NULL',
			'NR_STAFFEL' => 'int(11) NOT NULL',
			'DEUTSCHER_TITEL' => 'varchar(255) NOT NULL',
			'ORIGINAL­TITEL' => 'varchar(255) NOT NULL',
			'ERSTAUS­STRAHLUNG_USA' => 'varchar(255) NOT NULL',
			'DEUTSCH­SPRACHIGE_ERSTAUS­STRAHLUNG­_(D)' => 'varchar(255) NOT NULL',
			'REGIE' => 'varchar(255) NOT NULL',
			'DREHBUCH' => 'varchar(255) NOT NULL',
			'US-QUOTEN' => 'varchar(255) NOT NULL',
			'INHALT' => 'text NOT NULL'
		), 'ENGINE=InnoDB');
		
		
		$sql="INSERT INTO `episoden` (`NR_TOTAL`, `NR_STAFFEL`, `DEUTSCHER_TITEL`, `ORIGINAL­TITEL`, `ERSTAUS­STRAHLUNG_USA`, `DEUTSCH­SPRACHIGE_ERSTAUS­STRAHLUNG­_(D)`, `REGIE`, `DREHBUCH`, `US-QUOTEN`, `INHALT`) VALUES
(8, 1, 'Vorsichtsmaßnahmen', 'Seven Thirty-Seven', '08. Mär 09', '15. Okt 09', 'Bryan Cranston', 'J. Roberts', '1,662 Mio.', 'Hank sichtet die Aufnahmen einer Sicherheitskamera, die einen Einbruch von Walter und Jesse zeigen. Als Tucos zweiter Gehilfe auch tot ist, fürchten die beiden Zeugen um ihr Leben. Hank gesteht Skyler, von Maries kleptomanischen Neigungen gewusst zu haben.'),
(9, 2, 'In der Falle', 'Grilled', '15. Mär 09', '22. Okt 09', 'Charles Haid', 'George Mastras', '', 'Tuco entführt Walter und Jesse. Die beiden versuchen ihm zu entkommen indem sie ihn vergiften. Währenddessen wird Walter zu Hause vermisst. Hanks Suche führt zu Tuco, den er erschießt. Walter und Jesse können daraufhin fliehen.'),
(10, 3, 'Gedächtnisschwund', 'Bit by a Dead Bee', '22. Mär 09', '29. Okt 09', 'Terry McDonough', 'Peter Gould', '1,129 Mio.', 'Um sein Verschwinden zu erklären, geht Walter nackt in ein Einkaufscenter und täuscht Gedächtnisschwund vor. Aus der Klinik, in die er daraufhin eingeliefert wurde, versucht Walter wieder entlassen zu werden. Skyler glaubt, dass Walter ein zweites Handy besitzt. Jesse verliert mit seinem Alibi sein gesamtes Geld. Dieses fehlt nun, um das mobile Drogenlabor, das Jesse vor der Polizei versteckt hat, auszulösen.'),
(11, 4, 'Ganz unten', 'Down', '29. Mär 09', '05. Nov 09', 'John Dahl', 'Sam Catlin', '1,294 Mio.', 'Walter gelingt es nicht, Skyler von seinen Lügengeschichten zu überzeugen. Jesse wird von seinen Eltern aufgrund des Drogenlabors im Keller aus seinem Haus geschmissen. Da er immer noch kein Geld hat, holt er sich den Wohnwagen ohne zu bezahlen.'),
(12, 5, 'Bruchschäden', 'Breakage', '05. Apr 09', '12. Nov 09', 'Johan Renck', 'Moira Walley-Beckett', '1,213 Mio.', 'Hank wird befördert. Jesse willigt ein, wieder mit Walter, der für Arztrechnungen Geld braucht, zusammenzuarbeiten. Dafür baut Jesse ein Vertriebsnetz mit Dealern für das Meth auf. Jesse zieht in eine neue Wohnung neben Jane. Skinny wird beraubt.'),
(13, 6, 'Kuckuck', 'Peekaboo', '12. Apr 09', '19. Nov 09', 'Peter Medak', 'J. Roberts & Vince Gilligan', '1,407 Mio', 'Um sich Respekt zu verschaffen, stattet Jesse dem Pärchen, das Skinny beraubt hat, einen unangemeldeten Besuch ab. Dort bekommt er schließlich auf Umwegen sein Geld zurück und erlebt unfreiwillig einen Mord. Gretchen erfährt, dass Walter Skyler belogen hat.'),
(14, 7, 'Negro Y Azul', 'Negro Y Azul', '19. Apr 09', '26. Nov 09', 'Félix Enríquez Alcalá', 'John Shiban', '', 'Jesse hat zu nichts mehr Lust. Walter will erst alleine weiter machen, doch dann versucht er den traumatisierten Jesse aufzurichten. Skyler holt sich einen neuen Job - und einen Verehrer. Hank stößt in Texas auf Ablehnung und gerät in einen Hinterhalt.'),
(15, 8, 'Beauftragen Sie Saul', 'Better Call Saul', '26. Apr 09', '03. Dez 09', 'Terry McDonough', 'Peter Gould', '1,035 Mio.', 'Hank ist traumatisiert. Badger wird verhaftet und Walter engagiert für ihn den abgebrühten Anwalt Saul Goodman. Dieser will jedoch Heisenberg belasten. Also versuchen Walter und Jesse es mit Erpressung. Letztendlich wird Saul der Anwalt von Heisenberg und ein anderer geht an Walters Stelle in den Knast.'),
(16, 9, '4 Tage Auszeit', '4 Days Out', '03. Mai 09', '10. Dez 09', 'Michelle Maxwell MacLaren', 'Sam Catlin', '', 'Walter denkt, dass er nicht mehr lange zu leben hat. Sein Geld geht zur Neige. Also lügt er Skyler an und fährt mit Jesse, der eigentlich Zeit mit Jane verbringen wollte, in die Wüste, um pfundweise Meth zu kochen. Dann gibt es Probleme mit der Batterie des Wohnwagens. Walter erfährt, dass der Tumor in seiner Lunge um 80 % geschrumpft ist. Jedoch bedeutet die Remission nicht die Heilung.'),
(17, 10, 'Schluss', 'Over', '10. Mai 09', '17. Dez 09', 'Phil Abraham', 'Moira Walley-Beckett', '', 'Walter kommt mit seiner Genesung nicht zurecht, also heimwerkelt er den ganzen Tag. Eine Party zu seiner Besserung endet im Streit, da Walter wie verwandelt ist. Deshalb möchte er das vorhandene Meth verkaufen und dann mit der Drogenproduktion aufhören.'),
(18, 11, 'Mandala', 'Mandala', '17. Mai 09', '07. Jan 10', 'Adam Bernstein', 'George Mastras', '—', 'Combo wird erschossen. Auf Anraten Sauls will Walter sich mit einem neuen Handelspartner treffen. Als nach mehreren Problemen der Drogendeal für fast 40 Pfund Meth laufen soll, setzen Skylers Wehen ein und Jesse und Jane sind high von Heroin.'),
(19, 12, 'Phoenix', 'Phoenix', '24. Mai 09', '14. Jan 10', 'Colin Bucksey', 'John Shiban', '', 'Walter verpasst Hollys Geburt aufgrund des erfolgreichen Drogendeals. Das Geld wäscht er über die Spendenwebsite seines Sohnes rein. Jane erpresst Walter, damit Jesse an seinen Anteil kommt, den Walter wegen seines Drogenkonsums verwahren wollte.'),
(20, 13, 'Krisen', 'ABQ', '31. Mai 09', '21. Jan 10', 'Adam Bernstein', 'Vince Gilligan', '1,5 Mio.', 'Jane stirbt nach dem Drogenkonsum an Erbrochenem während Walter tatenlos zusieht. Walter ist besorgt um Jesse, der sich Selbstvorwürfe macht. Skyler verlässt Walter, weil er sie angelogen hat. Zwei Flugzeuge kollidieren über Albuquerque aufgrund eines Fehlers von Janes traumatisiertem Vater.');";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$rowCount=$command->execute(); // execute the non-query SQL
		//$dataReader=$command->query(); // execute a query SQL
		
	}

	public function down()
	{
		echo "m131126_190004_init_db does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}