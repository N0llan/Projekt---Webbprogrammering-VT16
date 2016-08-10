<?php
require_once ('class/MyList.class.php');
/**
 * Daniel Jennebo
 * Programvaruteknik 2014
 * Webbprogrammering
 * 2016-02-07
 * Filen skapar klassen namnlist. Hanterar inläsning från databas och utskrift till html
 */
    class namnlist{
    	public $sorta;		//Medlemsvariabler
		public $lista;
		
		
		public function printSort()
		{
			echo $this->sorta;			//Skriver ut variabeln sorta
		}

		public function __construct($sorta){
			$this->sorta = $sorta;			//Sätter datamedlemmen
			$this->lista[] = new MyList();	//Deklarerar array som innehåller objekt av MyList klassen
			
		}
		
		public function printList()
		{
			$this->createList();		//Anropar createlist funktionen
			
			echo '<tr><td><b>Förnamn</b></td><td><b>Efternamn</b></td><td><b>Nick</b></td><td><b>E-post</b></td><td><b>Admin</b></td></tr>';
										//Loopar arrayen med våra MyList objekt
			for ($i = 1; $i<count($this->lista);$i++)
			{
				$last = 0;
				echo '<tr>';
				foreach ($this->lista[$i] as $k)
				{
					if ($last == 4)
					{
						if ($k == "t")
						{
							echo "<td>YES</td>";
						}
						else 
						{
							echo "<td>NO</td>";
						}
					}	
					else 
					{
						echo "<td>$k</td>";	
					}	
					$last++;	
				}
				echo '</tr>';
				
			}
		}
		public function createList()
		{
			$count = 0;
			$dbconn = pg_connect('host=webblabb.miun.se port=5432 dbname=daje1400 user=daje1400 password=QPm0nLg0r');
			if ($dbconn)		//Skapa en connection och kolla så den lyckats
			{
				if ($this->sorta == 'FÖRNAMN')
				{						//Skapar en query beroende på vilken sort vi vill ha
					$query = "SELECT firstname,lastname,nick,epost,admin FROM projekt.medlem ORDER BY firstname ASC;";
				}
				elseif ($this->sorta == 'NICK')
				{
					$query = "SELECT firstname,lastname,nick,epost,admin FROM projekt.medlem ORDER BY nick ASC;";
				}
				elseif ($this->sorta == 'EFTERNAMN')
				{

					$query = "SELECT firstname,lastname,nick,epost,admin FROM projekt.medlem ORDER BY lastname ASC;";
				}
				elseif ($this->sorta == 'EPOST')
				{
					$query = "SELECT firstname,lastname,nick,epost,admin FROM projekt.medlem ORDER BY epost ASC;";
				}
				$result = pg_query($dbconn,$query);	//Skapa en SQL fråga och skicka till databasen
				if ($result)	//Om vi lyckats med frågan
				{
					while ($row = pg_fetch_row($result, $count))
					{								//Lägger till i arrayen
						$this->lista[count($this->lista)]=new MyList($row[0],$row[1],$row[2],$row[3],$row[4]);
						$count++;
					}
				}	
				pg_free_result($result);	
			}
			else 
			{
				echo "Connection failed";
			}
			pg_close();		//Stänger anslutning till databasen
			
		}
				
	}
    
?>

