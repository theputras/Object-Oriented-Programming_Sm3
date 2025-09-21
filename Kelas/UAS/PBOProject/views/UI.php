<?PHP
	class UI{
		public static function setTitle($judul){
			echo "<!DOCTYPE html><html>";
			echo "<title>$judul</title>";
			echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
			echo '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">';
			echo '<link href="views/assets/tailwind.css" rel="stylesheet">';
			echo '<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>';
			echo '<script src="https://cdn.tailwindcss.com"></script>';
			echo "<body class=\"bg-white\">";
		}
		public static function setHeader($header){
			echo '<div class="w-full h-full p-4 bg-green-600">';
			echo "<h1 class=\"text-white text-2xl\">$header</h1>";
			echo "</div>";
		}
		public static function setFooter($footer){
			echo '<div class="w-full h-full p-4 bg-green-400">';
			echo "<p >$footer</p>";
			echo "</div>";
			echo "</body></html>";
		}
	}
?>