-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 09, 2019 at 07:15 PM
-- Server version: 5.5.62-0+deb8u1
-- PHP Version: 5.6.40-0+deb8u2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `libreria`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`idCategoria` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Nombre de la categoria.',
  `descripcion` varchar(60) COLLATE utf8_spanish_ci NOT NULL COMMENT 'La descripcion de la categoria.',
  `anuncio` tinytext COLLATE utf8_spanish_ci NOT NULL,
  `codigo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`, `descripcion`, `anuncio`, `codigo`, `visible`) VALUES
(1, 'Historica', 'Descripcion novela historica', '', 'H', 0),
(2, 'Ciencía ficción', 'Descripcion novela c.ficcion', '', 'CF', 0),
(3, 'Terror', 'Descripcion novela terror', '', 'T', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lineaDePedido`
--

CREATE TABLE IF NOT EXISTS `lineaDePedido` (
`idItem` int(11) NOT NULL,
  ` precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(5) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
`idPedido` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` int(45) NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Guarda los pedidos realizados por los clientes, un cliente podra realizar tantos pedidos como desee y cada pedido es unico de un cliente.';

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`idProducto` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(2) NOT NULL,
  `iva` tinyint(2) NOT NULL,
  `stock` tinyint(4) NOT NULL,
  `isbn` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `anuncio` tinytext COLLATE utf8_spanish_ci,
  `destacado` tinyint(1) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `visible` tinyint(1) NOT NULL COMMENT 'El producto sera visible si vale 1, sino valdra 0',
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `imagen`, `descripcion`, `precio`, `descuento`, `iva`, `stock`, `isbn`, `anuncio`, `destacado`, `desde`, `hasta`, `visible`, `idCategoria`) VALUES
(1, 'El conde de Montecristo', '', 'El conde de Montecristo es uno de los clásicos más populares de todos los tiempos. Desde su publicación, en 1844, no ha dejado de seducir al gran público con la inolvidable historia de su protagonista.\r\n\r\nEdmond Dantés es un joven marinero, honrado y cándido, que lleva una existencia tranquila. Quiere casarse con la hermosa Mercedes, pero su vida se verá arruinada cuando su mejor amigo, Ferdinand, deseoso de conquistar a su prometida, le traicione vilmente. Condenado a cumplir una condena que no merece en la siniestra prisión del castillo de If, Edmond vivirá una larga pesadilla de trece años. Obsesionado por su inesperado destino, dejará de lado sus convicciones en torno al bien y al mal, y se dedicará a tramar la venganza perfecta.\r\n\r\nHistoria transida de densidad moral y cívica, El conde de Montecristo es, hoy como ayer, una novela amena, iluminadora y fascinante en sus múltiples dimensiones.', 19.00, 3, 0, 5, '2147483647', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(2, 'Origen', '', 'Robert Langdon, profesor de simbología e iconografía religiosa de la universidad de Harvard, acude al Museo Guggenheim Bilbao para asistir a un trascendental anuncio que «cambiará la faz de la ciencia para siempre». El anfitrión de la velada es Edmond Kirsch, un joven multimillonario cuyos visionarios inventos tecnológicos y audaces predicciones lo han convertido en una figura de renombre mundial. Kirsch, uno de los alumnos más brillantes de Langdon años atrás, se dispone a revelar un extraordinario descubrimiento que dará respuesta a las dos preguntas que han obsesionado a la humanidad desde el principio de los tiempos.\r\n\r\n¿DE DÓNDE VENIMOS? ¿ADÓNDE VAMOS?\r\n\r\nAl poco tiempo de comenzar la presentación, meticulosamente orquestada por Edmond Kirsch y la directora del museo Ambra Vidal, estalla el caos para asombro de cientos de invitados y millones de espectadores en todo el mundo. Ante la inminente amenaza de que el valioso hallazgo se pierda para siempre, Langdon y Ambra deben huir desesperadamente a Barcelona e iniciar una carrera contrarreloj para localizar la críptica contraseña que les dará acceso al revolucionario secreto de Kirsch.\r\n\r\nPerseguidos por un atormentado y peligroso enemigo, Langdon y Ambra descubrirán los episodios más oscuros de la Historia y del extremismo religioso. Siguiendo un rastro de pistas compuesto por obras de arte moderno y enigmáticos símbolos, tendrán pocas horas para intentar desvelar la fascinante investigación de Kirsch… y su sobrecogedora revelación sobre el origen y el destino de la Humanidad.\r\n\r\nORIGEN se desarrolla íntegramente en España. Barcelona, Bilbao, Madrid y Sevilla son los escenarios principales en los que transcurre la nueva aventura de Robert Langdon. De la mano del autor de El código Da Vinci, el lector recorrerá escenarios como el Monasterio de Montserrat, la Casa Milà (La Pedrera), la Sagrada Familia, el Museo Guggenheim Bilbao, el Palacio Real o la Catedral de Sevilla.\r\n\r\nComo ya sucedió con París en El código Da Vinci, con Roma en Ángeles y demonios o con Florencia en Inferno, los escenarios de las novelas de Dan Brown siempre han sido un elemento clave en sus tramas.\r\nOcultar resumen completo\r\npack annabelle', 21.38, 5, 0, 0, '2147483647', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(3, 'La cupula', '', 'Es una soleada mañana de otoño en la pequeña ciudad de Chester''s Mill. Claudette Sanders disfruta de su clase de vuelo y Dale Barbara, Barbie para los amigos, hace autostop en las afueras. Ninguno de los dos llegará a su destino...De repente, una barrera invisible cae sobre la ciudad como una burbuja cristalina e inquebrantable. Al descender corta por la mitad a una marmota y amputa la mano a un jardinero. El avión que pilotaba Claudette choca contra la cúpula y se precipita al suelo envuelto en llamas.Dale, veterano de la guerra de Irak, ha de regresar a Chester''s Mill, el lugar que tanto deseaba abandonar, pues el ejército ha decidido ponerle a cargo de la situación, pero Big Jim Rennie, el hombre que tiene un pie en todos los negocios sucios de la ciudad, no está de acuerdo: la cúpula podría ser la respuesta a sus plegarias.A medida que la comida, la electricidad y el agua escasean, los niños comienzan a tener premoniciones escalofriantes. El tiempo se acaba para aquellos que viven bajo la cúpula. ¿Podrán averiguar qué ha creado tan terrorífica prisión antes de que sea demasiado tarde?', 29.00, 10, 0, 0, '2147483647', NULL, 0, '0000-00-00', '0000-00-00', 0, 2),
(4, 'Una columna de fuego', '', '', 23.65, 7, 0, 0, '2147483647', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(5, 'Cien años de soledad', '', '«Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.» Con estas palabras empieza una novela ya legendaria en los anales de la literatura universal, una de las aventuras literarias más fascinantes de nuestro siglo. Millones de ejemplares de Cien años de soledad leídos en todas las lenguas y el premio Nobel de Literatura coronando una obra que se había abierto paso «boca a boca» -como gusta decir el escritor- son la más palpable demostración de que la aventura fabulosa de la familia Buendía-Iguarán, con sus milagros, fantasías, obsesiones, tragedias, incestos, adulterios, rebeldías, descubrimientos y condenas, representaba al mismo tiempo el mito y la historia, la tragedia y el amor del mundo entero.', 20.81, 7, 0, 0, '9788439728368', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(6, 'E angel perdido', '', 'Tal vez no sea casual que ahora tú, que has fi nalizado la lectura de El ángel perdido, tengas este diccionario con sus términos clave en las manos. Con él accederás a la verdadera trastienda de conceptos, lecturas, fuentes, leyendas y hechos que sustentaron el armazón de mi novela. Y podrás, como yo hice, sumergirte en esa «historia maldita» de nuestra especie que persigo desde mi primer libro. Te adentrarás, pues, en ese relato primordial que se transmitía en voz baja desde antes del tiempo de Jesús y en el que se enseñaba que nuestra especie nació de un mestizaje divino. De una mezcla de sangres foráneas y autóctonas que nos convirtieron en lo que ahora somos: una desconcertante mezcla de ángeles y humanos.', 22.00, 0, 0, 0, '9788408107828', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(7, 'La piramide inmortal', '', 'Un lugar mágico. Un misterio desvelado. Un hombre eterno.\r\nEl gran misterio de la humanidad, la inmortalidad, es la piedra angular sobre la que giran los argumentos de la nueva novela de Javier Sierra, La pirámide inmortal, una versión revisada, actualizada y ampliada de su novela El secreto egipcio de Napoleón.\r\nDespués de El maestro del Prado, Javier Sierra vuelve con más emoción, más sentimiento, más enigmas.\r\nAgosto de 1799. Un hombre ha quedado atrapado en el interior de la Gran Pirámide y se debate entre la vida y la muerte. Es el joven general Napoleón Bonaparte. En ese lugar, aislado bajo toneladas de piedra, está a punto de serle revelado un secreto ancestral que alterará parasiempre su destino.\r\nAlquimistas, hechiceros, bailarinas egipcias, viejos maestros descendidos de las montañas y grandes personajes históricos competirán con él en la búsqueda del tesoro más preciado: la fórmula de la vida eterna.', 19.00, 5, 0, 4, '9788408131441', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(8, 'Vida de Steve Jobs', '', 'el fundador de Apple, escrita con su colaboración.\r\nTras más de cuarenta entrevistas con Steve Jobs y con un centenar de personas de su entorno, familiares, amigos, adversarios y colegas, esta es la biografía definitiva de uno de los iconos indiscutibles de nuestro tiempo, la crónica de la agitada vida y abrasiva personalidad del genio cuya creatividad, energía y perfeccionismo ha revolucionado seis industrias: informática, películas de animación, música, teléfonos, tabletas y edición digital. Cuando el mundo busca cómo construir las bases de una economía digital, Jobs es un símbolo de la inventiva y de la imaginación práctica. Consciente de que la mejor manera de crear valor en el siglo XXI era conectar la creatividad con la tecnología, fundó una empresa en la que impresionantes saltos de la imaginación iban de la mano con asombrosos logros tecnológicos. Aunque Jobs colaboró con el libro, no pidió ningún control sobre el contenido, ni siquiera el derecho a leerlo antes de la publicación. No rehuyó ningún tema y animó a la gente que conocía a hablar con franqueza. He hecho muchas cosas de las que no me siento orgulloso, como dejar a mi novia embarazada a los 23 años y cómo me comporté entonces, pero no hay ningún cadáver en mi armario que no pueda salir a la luz. Jobs habla con sinceridad, a veces brutal, sobre la gente con la que ha trabajado y contra la que ha competido. De igual modo, sus amigos, rivales y colegas ofrecen una vision sin edulcorar de las pasiones, los demonios, el perfeccionismo, los deseos, el talento, los trucos y la obsesión por controlarlo todo que modelan su visión empresarial y los innovadores productos que logró crear. Jobs podia desesperar a quienes le rodeaban. Pero su personalidad y sus productos han estado siempre interrelacionados, igual que el hardware y el software de Apple forman un potente sistema integrado. Su historia, por tanto, está llena de lecciones sobre innovación, carácter, liderazgo y valores. La historia de un genio capaz de enfurecer y seducir a partes iguales.', 23.00, 0, 0, 3, ' 9788499921181', NULL, 0, '0000-00-00', '0000-00-00', 0, 3),
(9, 'Willian Martin, el hombre que nunca existio', '', 'El 30 de abril de 1943 un pescador de Punta Umbría encontró flotando en el mar el cadáver de un oficial británico, el comandante William Martin, con un maletín encadenado a su cuerpo. Antes de devolverlo a los británicos, las autoridades españolas transcribieron los papeles que contenía el maletín, incluyendo los planes para un desembarco en Grecia, y los hicieron llegar al gobierno alemán, que se preparó para organizar su defensa. Pero donde los aliados desembarcaron, tres meses después, fue en Sicilia. William Martin no había existido nunca y los papeles de su maletín estaban destinados a engañar a los alemanes. El gobierno británico no permitió nunca contar la auténtica historia de esta operación, por temor a la reacción española; pero Ben MacIntyre, el autor de Zigzag, ha accedido a los documentos originales y nos cuenta por fin toda la verdad acerca de una de las historias de espías más fascinantes de la Segunda Guerra Mundial, incluyendo la evidencia de la complicidad de los militares españoles con los nazis.', 12.00, 0, 0, 0, '9788404737529', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(10, 'Los asesinos del emperador', '', 'En la tempestuosa Roma del siglo I d.C. los atemorizados ciudadanos intentan sobrevivir al reinado de Domiciano, un emperador dispuesto siempre a condenar a muerte a cualquiera que pudiera hacerle sombra. En este ambiente turbulento se fragua una conspiración para asesinarlo. La conjura es complicada de trazar y muy peligrosa para todos los implicados, entre los que se encuentran Trajano y Domicia, la emperatriz, pieza clave en esta conspiración. Las mayores difi cultades estriban en burlar la guardia pretoriana. Pero un grupo de gladiadores sin nada que perder, serán los encargados de encontrar la fi sura. Trajano, primer emperador hispano de la Historia, es conocido sobre todo por conducir al Imperio romano a su máxima extensión. Lo que no se suele conocer tanto es su heroicidad más valiosa: la capacidad de Trajano para sobrevivir al reinado de Tito Flavio Domiciano, un emperador débil y paranoico siempre dispuesto a condenar a muerte a cualquiera que destacara en el ejército o en la política. Pero ¿qué ocurrió para que Roma aceptara por emperador a alguien no nacido en la misma Roma, sino a alguien proveniente de las lejanas y agrestes tierras de Hispania? Modifi car el curso de la Historia es prácticamente imposible. Sólo unos pocos se atreven a intentarlo y sólo uno entre millones, siempre de forma inesperada para todos, es capaz de conseguirlo. Bienvenidos al mundo de Marco Ulpio Trajano.', 21.00, 10, 0, 0, ' 9788408103257', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(11, 'La mano de Fatima', '', 'En la opulenta Córdoba de la segunda mitad del siglo XVI, un joven morisco, desgarrado entre dos culturas y dos amores, inicia una ardiente lucha por la tolerancia religiosa y los derechos de su pueblo.En 1568, en los valles y montes de las Alpujarras, ha estallado el grito de la rebelión: hartos de injusticias, expolio y humillaciones, los moriscos se enfrentan a los cristianos e inician una desigual pugna que sólo podía terminar con su derrota y dispersión por todo el reino de Castilla. Entre los sublevados se encuentra el joven Hernando. Hijo de una morisca y el sacerdote que la violó, es rechazado por los suyos, debido a su origen, y por los cristianos, por la cultura y costumbres de su familia. Durante la insurrección conoce la brutalidad y crueldad de unos y otros, pero también encuentra el amor en la figura de la valerosa Fátima, la de los grandes ojos negros. A partir de la derrota, forzado a vivir en Córdoba y en medio de las dificultades de la existencia cotidiana, todas sus fuerzas se concentrarán en lograr que su cultura y religión, las de los vencidos, recuperen la dignidad y el papel que merecen. Para ello deberá correr riesgos y atreverse con audaces y muy peligrosas iniciativas.Los lectores de La catedral del mar encontrarán en esta segunda novela de su autor las mismas claves que llevaron al éxito a la primera: la fidelidad histórica, que se entrevera con un apasionado relato de amor y odio, de ilusiones perdidas y esperanzas que dan sentido a la vida y la lanzan por los caminos de la aventura. De ese modo, su autor construye una trepidante novela que pretende reflejar la tragedia del pueblo morisco, ahora que se cumple el cuarto centenario de su expulsión de España, y que también relata una vida singular, la de un hombre fronterizo y enamorado que nunca se resignó a la derrota y luchó por la convivencia.', 21.00, 0, 0, 0, ' 9788425343544', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(12, 'Rezar por Miguel Angel', '', 'uropa, siglo XVI. El descubrimiento de un nuevo mundo pone en evidencia a las Sagradas Escrituras. Nuevas tierras y razas que no aparecen en la Biblia tambalean los cimientos del cristianismo mientras Martín Lutero se enfrenta a la Santa Sede y provoca un cisma con terribles daños colaterales.\r\n\r\nLa Florencia de los Médici verá partir a un joven Michelangelo Buonarroti, llamado por los Estados Vaticanos, donde alcanzará la gloria en la Ciudad Eterna. Mediante cincel, pigmento y carácter creará su propia leyenda mientras el mundo conocido no volverá a ser el mismo.\r\n\r\nMientras, al otro lado del Mediterráneo, el hijo de Juana I y Felipe el Hermoso accederá al trono de España y se convertirá en el emperador del Sacro Imperio Romano Germánico, lo que supondrá un gran problema para la Francia de Francisco I y la Roma de Gregorio XIII.\r\n\r\nMichelangelo Buonarroti creará.\r\nCarlos V destruirá.\r\nGregorio XIII rezará.\r\nY la Iglesia Católica cambiará para siempre ', 18.00, 0, 0, 0, '9788466338806', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(13, 'Por quien doblan las campanas', '', 'es una de las novelas más populares de Hemingway. Ambientada en la guerra civil española, la obra es una bella historia de amor y muerte que, en la nueva y espléndida traducción de Miguel Temprano García, vuelve a ejercer la seducción intemporal que la convirtió en un clásico de nuestro tiempo. #Robert Jordan, profesor de español oriundo de Montana, lucha en el bando republicano como especialista en explosivos. Cuando el general Golz le encarga la destrucción de un puente, vital para evitar la contraofensiva del bando nacional durante la batalla de Segovia, conoce a María, una joven muchacha de la que se enamora y le devolverá el amor a la vida. #Setenta años después del fin de la guerra civil, Por quién doblan las campanas sigue siendo una de las mejores y más hermosas novelas que se han escrito sobre el conflicto', 25.00, 15, 0, 0, '9788497935029', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(14, 'Don Quijote de la Mancha', '', ' es considerado por muchos críticos como el mejor texto literario jamás escrito. Supuso un hito indiscutible en la historia de la literatura, y es el libro más traducido después de la Biblia. Sus personajes han pasado a formar parte de la cultura popular, y representan aspectos sociales y psicológicos que hoy día siguen vigentes, al igual que el estilo literario de Cervantes, que tampoco ha envejecido desde la publicación de esta obra, hace más de cuatro siglos. La primera parte se publicó en 1605, y tal fue su éxito que ese mismo año se reimprimió varias veces y fue traducida al francés y al inglés.\r\n\r\nEsta edición, que conmemora el IV centenario de la publicación de la segunda parte, en 1615', 35.00, 0, 0, 0, '1236547896', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(15, 'Doctor sueño', '', 'Ahora Danny Torrance, aquel niño aterrorizado del Hotel Overlook, es un adulto alcohólico atormentado por los fantasmas de su infancia. Un día se siente atraído por una ciudad de New Hampshire, donde encontrará trabajo en una residencia de ancianos y donde se apuntará a las reuniones de Alcohólicos Anónimos. En ese lugar le llega la visión de Abra Stone, una niña que necesita su ayuda. La persigue una tribu de seres paranormales que vive del resplandor de los niños especiales. Parecen personas mayores y totalmente normales que viajan por el país en sus autocaravanas, pero su misión es capturar, torturar y consumir a estos niños. Se alimentan de ellos para vivir y el resplandor de Abra tiene tanta fuerza que les podría mantener vivos durante mucho tiempo.\r\n\r\nDanny sabe que sin su ayuda Abra nunca conseguiría escaparse de ellos; juntos emprenderán una lucha épica, una batalla sangrienta entre el Bien y el Mal, para intentar salvarla a ella y a los demás niños que sacrifican.\r\n\r\n\r\nUna novela que entusiasmará a los millones de lectores de El resplandor y que encantará a todos los que conozcan a Danny Torrance por primera vez.\r\n\r\nUna novela icónica en la obra de Stephen King.', 23.00, 25, 0, 0, ' 9788401354809', NULL, 0, '0000-00-00', '0000-00-00', 0, 2),
(16, 'It', '', 'Tras lustros de tranquilidad y lejania una antigua promesa infantil les hace volver al lugar en el que vivieron su infancia y juventud como una terrible pesadilla. Regresan a Derry para enfrentarse con su pasado y enterrar definitivamente la amenaza que los amargó durante su niñez. Saben que pueden morir, pero son conscientes de que no conocerán la paz hasta que aquella cosa sea destruida para siempre. It es una de las novelas más ambiciosas de Stephen King, donde ha logrado perfeccionar de un modo muy personal las claves del género de terro', 18.00, 8, 0, 0, ' 9788497593793', NULL, 0, '0000-00-00', '0000-00-00', 0, 2),
(17, 'Matar a Leonardo Da Vinci', '', '"Meser Leonardo da Vinci tiene un concepto tan herético que no se atiene a ninguna religión y estima más ser filósofo que cristiano. Por lo tanto, la resolución es firme y clara: debemos matar a Leonardo da Vinci".Europa, siglo XIV. Mientras España, Francia e Inglaterra ultiman su unificación, los Estados italianos se ven envueltos en conflictos permanentes por culpa de la religión, el poder y el ansia de expansión territorial. Lo único que les une es el renacimiento cultural de las artes. En la Florencia de los Médici, epicentro de este despliegue artístico, una mano anónima acusa de sodomía a un joven y prometedor Leonardo da Vinci. Durante dos meses será interrogado y torturado hasta que la falta de pruebas lo ponga en libertad. Con la reputación dañada, Leonardo partirá hacia nuevos horizontes para demostrar su talento y apaciguar las secuelas psicológicas provocadas en prisión.¿Quién lo acusó? ¿Con qué motivo? Mientras se debate entre evasión ovenganza Leonardo descubrirá que no todo es lo que parece cuando se trata de alcanzar el éxito.Haciendo gala de un estilo documental exhaustivo y exquisito, fruto de varios años de investigación y de viajes a los escenarios más representativos de la vida del genio, Christian Gálvez construye un thriller histórico, una novela de aventuras en la que se dan cita arte, venganza y pasión. Una obra que atrapa desde las primeras páginas y que cambiará la opinión que hasta ahora se tiene del genio florentino.', 24.00, 15, 0, 0, '9788483656358', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(18, 'Puerto escondido', '', 'Oliver, un joven londinense con una peculiar situación familiar y una triste pérdida, hereda una casona colonial, Villa Marina, a pie de playa en el pueblecito costero de Suances, en Cantabria. En las obras de remodelación se descubre en el sótano el cadáver emparedado de un bebé, al que acompaña un objeto que resulta completamente anacrónico.  Tras este descubrimiento comienzan a sucederse, de forma vertiginosa, diversos asesinatos en la zona (Suances, Santillana del Mar, Santander, Comillas), que, unidos a los insólitos resultados forenses de los cadáveres, ponen en jaque a la Sección de Investigación de la Guardia Civil y al propio Oliver, que inicia un denso viaje personal y una carrera a contrarreloj para descubrir al asesino.', 32.00, 5, 0, 0, '9788423349524', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(19, 'Fantasmas', '', 'La doctora Jenny Paige y su hermana, la pequeña Lisa, vuelven al pueblo de Snowfield, ya que se aproxima la temporada alta y tienen que poner en marcha la consulta antes de que lleguen los turistas en invierno.\r\n\r\nEl pueblo se encuentra particularmente tranquilo y el silencio es total. Una vez en la consulta, encuentran a la asistenta en la cocina muerta, con el cuerpo hinchado y amoratado. El agente al cargo del pueblo también está muerto, por lo que tienen que pedir ayuda a una población cercana, desde donde enviarán a un grupo de policías para la investigación.\r\n\r\nLa historia desarrolla esta investigación, a la que se une más tarde un grupo científico del ejército. Todo el pueblo ha muerto o ha desaparecido, del mismo modo que comienzan a desaparecer miembros del grupo. Los encuentros con fuerzas desconocidas y seres de pesadilla son constantes y sólo una persona puede ayudarles: el científico Thimoty Flyte. Con su ayuda intentarán terminar con el Antiguo Enemigo, una criatura de millones de años de edad que durante su historia ha hecho desaparecer un gran número de criaturas y asentamientos humanos. ', 24.00, 0, 0, 0, '842701242X', NULL, 0, '0000-00-00', '0000-00-00', 0, 2),
(20, 'La historia interminable', '', '¿Qué es Fantasia? Fantasia es la Historia Interminable. ¿Dónde está escrita esa historia? En un libro de tapas color cobre. ¿Dónde está ese libro? Entonces estaba en el desván de un colegio... Estas son las tres preguntas que formulan los Pensadores Profundos, y las tres sencillas respuestas que reciben de Bastián. Pero para saber realmente lo que es Fantasia hay que leer ese, es decir, este libro. El que tienes en tus manos.\r\n\r\nLa Emperatriz Infantil está mortalmente enferma y su reino corre un grave peligro. La salvación depende de Atreyu, un valiente guerrero de la tribu de los pieles verdes, y Bastián, un niño tímido que lee con pasión un libro mágico. Mil aventuras les llevarán a reunirse y a conocer una fabulosa galería de personajes, y juntos dar forma a una de las grandes creaciones de la literatura de todos los tiempos.', 26.00, 4, 0, 14, '9788420471549', NULL, 0, '0000-00-00', '0000-00-00', 0, 1),
(21, 'Un saco de huesos', '', '\r\n\r\nLa novela más emocionante e inolvidable de Stephen King. Una historia sobre el sufrimiento por un amor malogrado, un nuevo amor amenazado por secretos del pasado y una inocente niña atrapada entre fuerzas naturales y sobrenaturales.\r\n\r\nCuatro años después de la repentina muerte de su esposa, el novelista Mike Noonan sigue preso de una terrible depresión y de espantosas pesadillas. Por ello decide buscar refugio en su casa de veraneo, Sara Risa.\r\n\r\nAllí conoce a Mattie y a su hija pequeña Kyra, quienes sufren el acoso de Max Devore, el padre de Mattie, un hombre poderoso y sin escrúpulos que trata por todos los medios de conseguir la custodia de su nieta con oscuras intenciones.\r\n\r\nPronto Mike se verá involucrado en el enfrentamiento familiar y, al mismo tiempo, irá descubriendo que Sara Risa se ha convertido en escenario de visitas fantasmales y obsesiones cada vez más abominables.\r\n', 25.00, 7, 0, 2, '9788490326183', NULL, 0, '0000-00-00', '0000-00-00', 0, 2);

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
`idProvincia` int(10) unsigned NOT NULL,
  `provincia` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `CodigoPostalDesde` int(10) NOT NULL,
  `codigoPostalHasta` int(10) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`idProvincia`, `provincia`, `CodigoPostalDesde`, `codigoPostalHasta`) VALUES
(1, 'Álava', 1000, 1520),
(2, 'Albacete', 2000, 2696),
(3, 'Alicante', 3000, 3860),
(4, 'Almería', 4000, 4897),
(5, 'Ávila', 5000, 5697),
(6, 'Badajoz', 6000, 6980),
(7, 'Islas Balears', 7000, 7860),
(8, 'Barcelona', 8000, 8980),
(9, 'Burgos', 9000, 9693),
(10, 'Cáceres', 10000, 10991),
(11, 'Cádiz', 11000, 11693),
(12, 'Castellón', 12000, 12609),
(13, 'Ciudad Real', 13000, 13779),
(14, 'Córdoba', 14000, 14970),
(15, 'La Coruña', 15000, 15981),
(16, 'Cuenca', 16000, 16891),
(17, 'Gerona', 17000, 17869),
(18, 'Granada', 18000, 18890),
(19, 'Guadalajara', 19000, 19495),
(20, 'Guipúzcoa', 20000, 20870),
(21, 'Huelva', 21000, 21891),
(22, 'Huesca', 22000, 22880),
(23, 'Jaén', 23000, 23790),
(24, 'León', 24000, 24996),
(25, 'Lerida', 25000, 25796),
(26, 'La Rioja', 26000, 26589),
(27, 'Lugo', 27000, 27891),
(28, 'Madrid', 28000, 28991),
(29, 'Málaga', 29000, 29792),
(30, 'Murcia', 30000, 30892),
(31, 'Navarra', 31000, 31890),
(32, 'Orense', 32000, 32930),
(33, 'Asturias', 33000, 33993),
(34, 'Palencia', 34000, 34889),
(35, 'Las Palmas', 35000, 35640),
(36, 'Pontevedra', 36000, 36980),
(37, 'Salamanca', 37000, 37900),
(38, 'Santa Cruz de Tenerife', 38000, 38911),
(39, 'Cantabria', 39000, 39880),
(40, 'Segovia', 40000, 40593),
(41, 'Sevilla', 41000, 41980),
(42, 'Soria', 42000, 42368),
(43, 'Tarragona', 43000, 43896),
(44, 'Teruel', 44000, 44793),
(45, 'Toledo', 45000, 45960),
(46, 'Valencia', 46000, 46980),
(47, 'Valladolid', 47000, 47883),
(48, 'Vizcaya', 48000, 48992),
(49, 'Zamora', 49000, 49882),
(50, 'Zaragoza', 50000, 50840),
(51, 'Ceuta', 51000, 51001),
(52, 'Melilla', 52000, 52001);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`idUsuario` int(4) NOT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `contraseña` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `provincia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `baja` tinyint(1) NOT NULL DEFAULT '0',
  `tipo` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `correo`, `contraseña`, `nombre`, `apellidos`, `dni`, `direccion`, `codigoPostal`, `provincia`, `baja`, `tipo`) VALUES
(31, 'jcortes181', 'nueo@yahoo.es', '81dc9bdb52d04dc20036dbd8313ed055', 'Jose Luis', 'Radiero', '39026388b', 'Dario 3', 22445, 'huelva', 0, 'administrador'),
(33, 'skyrim', 'mijuego@hotmail.com', '1a98fcbc13d1350359b2a41ff02f9281', 'Racio', 'Delgado', '39026388b', 'ave san carlps 1', 21004, 'Álava', 0, 'cliente'),
(34, 'jose', 'jose@hotmail.es', '81dc9bdb52d04dc20036dbd8313ed055', 'jose luis', 'cortes', '48927740R', 'Avd Cristobal', 21005, 'Huelva', 0, 'cliente');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`idCategoria`);

--
-- Indexes for table `lineaDePedido`
--
ALTER TABLE `lineaDePedido`
 ADD PRIMARY KEY (`idItem`), ADD KEY `fk_lineaDePedido_pedidos1_idx` (`idPedido`), ADD KEY `fk_lineaDePedido_productos1_idx` (`idProducto`), ADD KEY `idPedido` (`idPedido`), ADD KEY `idPedido_2` (`idPedido`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
 ADD PRIMARY KEY (`idPedido`), ADD KEY `idUsuario` (`idUsuario`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`idProducto`), ADD KEY `idCategoria` (`idCategoria`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
 ADD PRIMARY KEY (`idProvincia`), ADD UNIQUE KEY `IDX_provincia` (`provincia`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lineaDePedido`
--
ALTER TABLE `lineaDePedido`
MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
MODIFY `idProvincia` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lineaDePedido`
--
ALTER TABLE `lineaDePedido`
ADD CONSTRAINT `lineaDePedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `lineaDePedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
