-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 29, 2019 at 05:48 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`idCategoria`, `nombre`, `descripcion`, `anuncio`, `codigo`, `visible`) VALUES
(1, 'Historica', 'Descripcion novela historica', '', 'H', 1),
(2, 'Ciencía ficción', 'Descripcion novela c.ficcion', '', 'CF', 1),
(3, 'Terror', 'Descripcion novela terror', '', 'T', 1),
(4, 'Biograficas', 'Libros de contenido biografico', '', 'Bio', 1),
(6, 'Novelas', 'Libros novelas ', '', 'Nov', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lineaDePedido`
--

CREATE TABLE IF NOT EXISTS `lineaDePedido` (
`idItem` int(11) NOT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(5) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `lineaDePedido`
--

INSERT INTO `lineaDePedido` (`idItem`, `precio`, `cantidad`, `idPedido`, `idProducto`) VALUES
(83, 23.00, 2, 64, 8),
(84, 25.00, 4, 64, 13),
(85, 35.00, 1, 64, 14),
(86, 23.00, 3, 64, 15),
(87, 18.00, 1, 64, 16),
(88, 24.00, 1, 64, 17),
(89, 26.00, 1, 64, 20),
(90, 25.00, 3, 64, 21),
(91, 25.00, 1, 65, 21),
(92, 29.00, 2, 65, 3),
(93, 18.00, 2, 65, 16),
(94, 19.00, 1, 66, 7),
(95, 22.00, 2, 66, 6),
(96, 19.00, 4, 67, 1),
(97, 21.38, 2, 67, 2),
(98, 29.00, 2, 67, 3),
(99, 23.65, 2, 67, 4),
(100, 20.81, 1, 67, 5),
(101, 22.00, 8, 67, 6),
(102, 23.65, 1, 68, 4),
(103, 29.00, 1, 68, 3),
(104, 19.00, 1, 68, 1),
(105, 23.65, 1, 69, 4),
(106, 20.81, 2, 69, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
`idPedido` int(11) NOT NULL,
  `estado` int(30) NOT NULL DEFAULT '1',
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(12) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `provincia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `cancelar` tinyint(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Guarda los pedidos realizados por los clientes, un cliente podra realizar tantos pedidos como desee y cada pedido es unico de un cliente.';

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `estado`, `fecha`, `nombre`, `apellidos`, `dni`, `direccion`, `codigoPostal`, `provincia`, `cancelar`, `idUsuario`) VALUES
(64, 1, '2019-05-29 03:11:40', 'Jose Luis', 'Cortes', '48927740R', 'Calle Praltra 5', 21004, '21', 0, 38),
(65, 2, '2019-05-29 03:11:54', 'Jose Luis', 'Cortes', '48927740R', 'Calle Praltra 5', 21004, '21', 0, 38),
(66, 1, '2019-05-29 01:54:51', 'Serena', 'Argiolas', '48927740r', 'Avd Tolomeo 5', 21005, '41', 0, 39),
(67, 1, '2019-05-29 02:56:38', 'Serena', 'Argiolas', '48927740r', 'Avd Tolomeo 5', 21005, '41', 0, 39),
(68, 1, '2019-05-29 02:56:43', 'Serena', 'Argiolas', '48927740r', 'Avd Tolomeo 5', 21005, '41', 0, 39),
(69, 1, '2019-05-29 03:11:46', 'Jose Luis', 'Cortes', '48927740R', 'Calle Praltra 5', 21004, '21', 0, 38);

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
  `stock` int(4) NOT NULL,
  `isbn` varchar(14) COLLATE utf8_spanish_ci NOT NULL,
  `anuncio` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
  `destacado` tinyint(1) NOT NULL,
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'El producto sera visible si vale 1, sino valdra 0',
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`idProducto`, `nombre`, `imagen`, `descripcion`, `precio`, `descuento`, `iva`, `stock`, `isbn`, `anuncio`, `destacado`, `desde`, `hasta`, `visible`, `idCategoria`) VALUES
(1, 'El conde de Montecristo', 'montecristo.jpg', 'El conde de Montecristo es uno de los clásicos más populares de todos los tiempos. Desde su publicación, en 1844, no ha dejado de seducir al gran público con la inolvidable historia de su protagonista.\r\n\r\nEdmond Dantés es un joven marinero, honrado y cándido, que lleva una existencia tranquila. Quiere casarse con la hermosa Mercedes, pero su vida se verá arruinada cuando su mejor amigo, Ferdinand, deseoso de conquistar a su prometida, le traicione vilmente. Condenado a cumplir una condena que no merece en la siniestra prisión del castillo de If, Edmond vivirá una larga pesadilla de trece años. Obsesionado por su inesperado destino, dejará de lado sus convicciones en torno al bien y al mal, y se dedicará a tramar la venganza perfecta.\r\n\r\nHistoria transida de densidad moral y cívica, El conde de Montecristo es, hoy como ayer, una novela amena, iluminadora y fascinante en sus múltiples dimensiones.', 19.00, 3, 0, 212, '2147483647', NULL, 1, '2019-05-23', '2019-05-23', 1, 6),
(2, 'Origen', 'origen.jpeg', 'Robert Langdon, profesor de simbología e iconografía religiosa de la universidad de Harvard, acude al Museo Guggenheim Bilbao para asistir a un trascendental anuncio que «cambiará la faz de la ciencia para siempre». El anfitrión de la velada es Edmond Kirsch, un joven multimillonario cuyos visionarios inventos tecnológicos y audaces predicciones lo han convertido en una figura de renombre mundial. Kirsch, uno de los alumnos más brillantes de Langdon años atrás, se dispone a revelar un extraordinario descubrimiento que dará respuesta a las dos preguntas que han obsesionado a la humanidad desde el principio de los tiempos.\r\n\r\n¿DE DÓNDE VENIMOS? ¿ADÓNDE VAMOS?\r\n\r\nAl poco tiempo de comenzar la presentación, meticulosamente orquestada por Edmond Kirsch y la directora del museo Ambra Vidal, estalla el caos para asombro de cientos de invitados y millones de espectadores en todo el mundo. Ante la inminente amenaza de que el valioso hallazgo se pierda para siempre, Langdon y Ambra deben huir desesperadamente a Barcelona e iniciar una carrera contrarreloj para localizar la críptica contraseña que les dará acceso al revolucionario secreto de Kirsch.\r\n\r\nPerseguidos por un atormentado y peligroso enemigo, Langdon y Ambra descubrirán los episodios más oscuros de la Historia y del extremismo religioso. Siguiendo un rastro de pistas compuesto por obras de arte moderno y enigmáticos símbolos, tendrán pocas horas para intentar desvelar la fascinante investigación de Kirsch… y su sobrecogedora revelación sobre el origen y el destino de la Humanidad.\r\n\r\nORIGEN se desarrolla íntegramente en España. Barcelona, Bilbao, Madrid y Sevilla son los escenarios principales en los que transcurre la nueva aventura de Robert Langdon. De la mano del autor de El código Da Vinci, el lector recorrerá escenarios como el Monasterio de Montserrat, la Casa Milà (La Pedrera), la Sagrada Familia, el Museo Guggenheim Bilbao, el Palacio Real o la Catedral de Sevilla.\r\n\r\nComo ya sucedió con París en El código Da Vinci, con Roma en Ángeles y demonios o con Florencia en Inferno, los escenarios de las novelas de Dan Brown siempre han sido un elemento clave en sus tramas.\r\nOcultar resumen completo\r\npack annabelle', 21.38, 5, 0, 37, '2147483647', NULL, 0, '2019-05-06', '2019-06-06', 1, 6),
(3, 'La cupula', 'cupula.jpg', 'Es una soleada mañana de otoño en la pequeña ciudad de Chester''s Mill. Claudette Sanders disfruta de su clase de vuelo y Dale Barbara, Barbie para los amigos, hace autostop en las afueras. Ninguno de los dos llegará a su destino...De repente, una barrera invisible cae sobre la ciudad como una burbuja cristalina e inquebrantable. Al descender corta por la mitad a una marmota y amputa la mano a un jardinero. El avión que pilotaba Claudette choca contra la cúpula y se precipita al suelo envuelto en llamas.Dale, veterano de la guerra de Irak, ha de regresar a Chester''s Mill, el lugar que tanto deseaba abandonar, pues el ejército ha decidido ponerle a cargo de la situación, pero Big Jim Rennie, el hombre que tiene un pie en todos los negocios sucios de la ciudad, no está de acuerdo: la cúpula podría ser la respuesta a sus plegarias.A medida que la comida, la electricidad y el agua escasean, los niños comienzan a tener premoniciones escalofriantes. El tiempo se acaba para aquellos que viven bajo la cúpula. ¿Podrán averiguar qué ha creado tan terrorífica prisión antes de que sea demasiado tarde?', 29.00, 10, 0, 209, '2147483647', NULL, 0, '2019-06-05', '2019-07-26', 1, 3),
(4, 'Una columna de fuego', 'unacolumnadefuego.jpg', '', 23.65, 7, 0, 96, '2147483647', NULL, 0, '2019-05-31', '2019-08-15', 1, 6),
(5, 'Cien años de soledad', 'cienyearsdesoledad.jpg', '«Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo.» Con estas palabras empieza una novela ya legendaria en los anales de la literatura universal, una de las aventuras literarias más fascinantes de nuestro siglo. Millones de ejemplares de Cien años de soledad leídos en todas las lenguas y el premio Nobel de Literatura coronando una obra que se había abierto paso «boca a boca» -como gusta decir el escritor- son la más palpable demostración de que la aventura fabulosa de la familia Buendía-Iguarán, con sus milagros, fantasías, obsesiones, tragedias, incestos, adulterios, rebeldías, descubrimientos y condenas, representaba al mismo tiempo el mito y la historia, la tragedia y el amor del mundo entero.', 20.81, 7, 0, 249, '9788439728368', NULL, 1, '2019-05-14', '2019-05-20', 1, 6),
(6, 'El angel perdido', 'elangelperdido.jpg', 'Tal vez no sea casual que ahora tú, que has fi nalizado la lectura de El ángel perdido, tengas este diccionario con sus términos clave en las manos. Con él accederás a la verdadera trastienda de conceptos, lecturas, fuentes, leyendas y hechos que sustentaron el armazón de mi novela. Y podrás, como yo hice, sumergirte en esa «historia maldita» de nuestra especie que persigo desde mi primer libro. Te adentrarás, pues, en ese relato primordial que se transmitía en voz baja desde antes del tiempo de Jesús y en el que se enseñaba que nuestra especie nació de un mestizaje divino. De una mezcla de sangres foráneas y autóctonas que nos convirtieron en lo que ahora somos: una desconcertante mezcla de ángeles y humanos.', 22.00, 0, 0, 79, '9788408107828', NULL, 1, '2019-10-08', '2019-10-17', 1, 6),
(7, 'La piramide inmortal', 'lapiramideinmortal.jpg', 'Un lugar mágico. Un misterio desvelado. Un hombre eterno.\r\nEl gran misterio de la humanidad, la inmortalidad, es la piedra angular sobre la que giran los argumentos de la nueva novela de Javier Sierra, La pirámide inmortal, una versión revisada, actualizada y ampliada de su novela El secreto egipcio de Napoleón.\r\nDespués de El maestro del Prado, Javier Sierra vuelve con más emoción, más sentimiento, más enigmas.\r\nAgosto de 1799. Un hombre ha quedado atrapado en el interior de la Gran Pirámide y se debate entre la vida y la muerte. Es el joven general Napoleón Bonaparte. En ese lugar, aislado bajo toneladas de piedra, está a punto de serle revelado un secreto ancestral que alterará parasiempre su destino.\r\nAlquimistas, hechiceros, bailarinas egipcias, viejos maestros descendidos de las montañas y grandes personajes históricos competirán con él en la búsqueda del tesoro más preciado: la fórmula de la vida eterna.', 19.00, 5, 0, 364, '9788408131441', NULL, 0, '2019-05-31', '2019-06-19', 1, 6),
(8, 'Vida de Steve Jobs', 'stevejob.jpg', 'el fundador de Apple, escrita con su colaboración.\r\nTras más de cuarenta entrevistas con Steve Jobs y con un centenar de personas de su entorno, familiares, amigos, adversarios y colegas, esta es la biografía definitiva de uno de los iconos indiscutibles de nuestro tiempo, la crónica de la agitada vida y abrasiva personalidad del genio cuya creatividad, energía y perfeccionismo ha revolucionado seis industrias: informática, películas de animación, música, teléfonos, tabletas y edición digital. Cuando el mundo busca cómo construir las bases de una economía digital, Jobs es un símbolo de la inventiva y de la imaginación práctica. Consciente de que la mejor manera de crear valor en el siglo XXI era conectar la creatividad con la tecnología, fundó una empresa en la que impresionantes saltos de la imaginación iban de la mano con asombrosos logros tecnológicos. Aunque Jobs colaboró con el libro, no pidió ningún control sobre el contenido, ni siquiera el derecho a leerlo antes de la publicación. No rehuyó ningún tema y animó a la gente que conocía a hablar con franqueza. He hecho muchas cosas de las que no me siento orgulloso, como dejar a mi novia embarazada a los 23 años y cómo me comporté entonces, pero no hay ningún cadáver en mi armario que no pueda salir a la luz. Jobs habla con sinceridad, a veces brutal, sobre la gente con la que ha trabajado y contra la que ha competido. De igual modo, sus amigos, rivales y colegas ofrecen una vision sin edulcorar de las pasiones, los demonios, el perfeccionismo, los deseos, el talento, los trucos y la obsesión por controlarlo todo que modelan su visión empresarial y los innovadores productos que logró crear. Jobs podia desesperar a quienes le rodeaban. Pero su personalidad y sus productos han estado siempre interrelacionados, igual que el hardware y el software de Apple forman un potente sistema integrado. Su historia, por tanto, está llena de lecciones sobre innovación, carácter, liderazgo y valores. La historia de un genio capaz de enfurecer y seducir a partes iguales.', 23.00, 0, 0, 148, ' 9788499921181', NULL, 0, '2019-05-13', '2019-06-14', 1, 4),
(9, 'El hombre que nunca existio', 'willianmartin.jpg', 'El 30 de abril de 1943 un pescador de Punta Umbría encontró flotando en el mar el cadáver de un oficial británico, el comandante William Martin, con un maletín encadenado a su cuerpo. Antes de devolverlo a los británicos, las autoridades españolas transcribieron los papeles que contenía el maletín, incluyendo los planes para un desembarco en Grecia, y los hicieron llegar al gobierno alemán, que se preparó para organizar su defensa. Pero donde los aliados desembarcaron, tres meses después, fue en Sicilia. William Martin no había existido nunca y los papeles de su maletín estaban destinados a engañar a los alemanes. El gobierno británico no permitió nunca contar la auténtica historia de esta operación, por temor a la reacción española; pero Ben MacIntyre, el autor de Zigzag, ha accedido a los documentos originales y nos cuenta por fin toda la verdad acerca de una de las historias de espías más fascinantes de la Segunda Guerra Mundial, incluyendo la evidencia de la complicidad de los militares españoles con los nazis.', 12.00, 0, 0, 99, '9788404737529', NULL, 1, '2019-05-27', '2019-05-29', 1, 1),
(10, 'Los asesinos del emperador', 'losasesinosdelemperador.jpg', 'En la tempestuosa Roma del siglo I d.C. los atemorizados ciudadanos intentan sobrevivir al reinado de Domiciano, un emperador dispuesto siempre a condenar a muerte a cualquiera que pudiera hacerle sombra. En este ambiente turbulento se fragua una conspiración para asesinarlo. La conjura es complicada de trazar y muy peligrosa para todos los implicados, entre los que se encuentran Trajano y Domicia, la emperatriz, pieza clave en esta conspiración. Las mayores difi cultades estriban en burlar la guardia pretoriana. Pero un grupo de gladiadores sin nada que perder, serán los encargados de encontrar la fi sura. Trajano, primer emperador hispano de la Historia, es conocido sobre todo por conducir al Imperio romano a su máxima extensión. Lo que no se suele conocer tanto es su heroicidad más valiosa: la capacidad de Trajano para sobrevivir al reinado de Tito Flavio Domiciano, un emperador débil y paranoico siempre dispuesto a condenar a muerte a cualquiera que destacara en el ejército o en la política. Pero ¿qué ocurrió para que Roma aceptara por emperador a alguien no nacido en la misma Roma, sino a alguien proveniente de las lejanas y agrestes tierras de Hispania? Modifi car el curso de la Historia es prácticamente imposible. Sólo unos pocos se atreven a intentarlo y sólo uno entre millones, siempre de forma inesperada para todos, es capaz de conseguirlo. Bienvenidos al mundo de Marco Ulpio Trajano.', 21.00, 10, 0, 46, ' 9788408103257', NULL, 0, '2018-11-04', '2019-07-04', 1, 1),
(11, 'La mano de Fatima', 'lamanodefatima.jpg', 'En la opulenta Córdoba de la segunda mitad del siglo XVI, un joven morisco, desgarrado entre dos culturas y dos amores, inicia una ardiente lucha por la tolerancia religiosa y los derechos de su pueblo.En 1568, en los valles y montes de las Alpujarras, ha estallado el grito de la rebelión: hartos de injusticias, expolio y humillaciones, los moriscos se enfrentan a los cristianos e inician una desigual pugna que sólo podía terminar con su derrota y dispersión por todo el reino de Castilla. Entre los sublevados se encuentra el joven Hernando. Hijo de una morisca y el sacerdote que la violó, es rechazado por los suyos, debido a su origen, y por los cristianos, por la cultura y costumbres de su familia. Durante la insurrección conoce la brutalidad y crueldad de unos y otros, pero también encuentra el amor en la figura de la valerosa Fátima, la de los grandes ojos negros. A partir de la derrota, forzado a vivir en Córdoba y en medio de las dificultades de la existencia cotidiana, todas sus fuerzas se concentrarán en lograr que su cultura y religión, las de los vencidos, recuperen la dignidad y el papel que merecen. Para ello deberá correr riesgos y atreverse con audaces y muy peligrosas iniciativas.Los lectores de La catedral del mar encontrarán en esta segunda novela de su autor las mismas claves que llevaron al éxito a la primera: la fidelidad histórica, que se entrevera con un apasionado relato de amor y odio, de ilusiones perdidas y esperanzas que dan sentido a la vida y la lanzan por los caminos de la aventura. De ese modo, su autor construye una trepidante novela que pretende reflejar la tragedia del pueblo morisco, ahora que se cumple el cuarto centenario de su expulsión de España, y que también relata una vida singular, la de un hombre fronterizo y enamorado que nunca se resignó a la derrota y luchó por la convivencia.', 21.00, 0, 0, 455, ' 9788425343544', NULL, 0, '2019-05-13', '2019-05-29', 1, 6),
(12, 'Rezar por Miguel Angel', 'rezarpormiguelangel.jpg', 'uropa, siglo XVI. El descubrimiento de un nuevo mundo pone en evidencia a las Sagradas Escrituras. Nuevas tierras y razas que no aparecen en la Biblia tambalean los cimientos del cristianismo mientras Martín Lutero se enfrenta a la Santa Sede y provoca un cisma con terribles daños colaterales.\r\n\r\nLa Florencia de los Médici verá partir a un joven Michelangelo Buonarroti, llamado por los Estados Vaticanos, donde alcanzará la gloria en la Ciudad Eterna. Mediante cincel, pigmento y carácter creará su propia leyenda mientras el mundo conocido no volverá a ser el mismo.\r\n\r\nMientras, al otro lado del Mediterráneo, el hijo de Juana I y Felipe el Hermoso accederá al trono de España y se convertirá en el emperador del Sacro Imperio Romano Germánico, lo que supondrá un gran problema para la Francia de Francisco I y la Roma de Gregorio XIII.\r\n\r\nMichelangelo Buonarroti creará.\r\nCarlos V destruirá.\r\nGregorio XIII rezará.\r\nY la Iglesia Católica cambiará para siempre ', 18.00, 0, 0, 707, '9788466338806', NULL, 0, '2019-05-12', '2019-06-12', 1, 6),
(13, 'Por quien doblan las campanas', 'porquiendoblanlascampanas.jpg', 'es una de las novelas más populares de Hemingway. Ambientada en la guerra civil española, la obra es una bella historia de amor y muerte que, en la nueva y espléndida traducción de Miguel Temprano García, vuelve a ejercer la seducción intemporal que la convirtió en un clásico de nuestro tiempo. #Robert Jordan, profesor de español oriundo de Montana, lucha en el bando republicano como especialista en explosivos. Cuando el general Golz le encarga la destrucción de un puente, vital para evitar la contraofensiva del bando nacional durante la batalla de Segovia, conoce a María, una joven muchacha de la que se enamora y le devolverá el amor a la vida. #Setenta años después del fin de la guerra civil, Por quién doblan las campanas sigue siendo una de las mejores y más hermosas novelas que se han escrito sobre el conflicto', 25.00, 15, 0, 138, '9788497935029', NULL, 0, '2019-05-31', '2019-07-17', 1, 6),
(14, 'Don Quijote de la Mancha', 'quijote.jpg', ' es considerado por muchos críticos como el mejor texto literario jamás escrito. Supuso un hito indiscutible en la historia de la literatura, y es el libro más traducido después de la Biblia. Sus personajes han pasado a formar parte de la cultura popular, y representan aspectos sociales y psicológicos que hoy día siguen vigentes, al igual que el estilo literario de Cervantes, que tampoco ha envejecido desde la publicación de esta obra, hace más de cuatro siglos. La primera parte se publicó en 1605, y tal fue su éxito que ese mismo año se reimprimió varias veces y fue traducida al francés y al inglés.\r\n\r\nEsta edición, que conmemora el IV centenario de la publicación de la segunda parte, en 1615', 35.00, 0, 0, 534, '1236547896', NULL, 0, '2019-05-20', '2019-08-08', 1, 6),
(15, 'Doctor sueño', 'doctorsueño.jpg', 'Ahora Danny Torrance, aquel niño aterrorizado del Hotel Overlook, es un adulto alcohólico atormentado por los fantasmas de su infancia. Un día se siente atraído por una ciudad de New Hampshire, donde encontrará trabajo en una residencia de ancianos y donde se apuntará a las reuniones de Alcohólicos Anónimos. En ese lugar le llega la visión de Abra Stone, una niña que necesita su ayuda. La persigue una tribu de seres paranormales que vive del resplandor de los niños especiales. Parecen personas mayores y totalmente normales que viajan por el país en sus autocaravanas, pero su misión es capturar, torturar y consumir a estos niños. Se alimentan de ellos para vivir y el resplandor de Abra tiene tanta fuerza que les podría mantener vivos durante mucho tiempo.\r\n\r\nDanny sabe que sin su ayuda Abra nunca conseguiría escaparse de ellos; juntos emprenderán una lucha épica, una batalla sangrienta entre el Bien y el Mal, para intentar salvarla a ella y a los demás niños que sacrifican.\r\n\r\n\r\nUna novela que entusiasmará a los millones de lectores de El resplandor y que encantará a todos los que conozcan a Danny Torrance por primera vez.\r\n\r\nUna novela icónica en la obra de Stephen King.', 23.00, 25, 0, 140, ' 9788401354809', NULL, 0, '2019-05-16', '2019-07-24', 1, 3),
(16, 'It', 'it.jpg', 'Tras lustros de tranquilidad y lejania una antigua promesa infantil les hace volver al lugar en el que vivieron su infancia y juventud como una terrible pesadilla. Regresan a Derry para enfrentarse con su pasado y enterrar definitivamente la amenaza que los amargó durante su niñez. Saben que pueden morir, pero son conscientes de que no conocerán la paz hasta que aquella cosa sea destruida para siempre. It es una de las novelas más ambiciosas de Stephen King, donde ha logrado perfeccionar de un modo muy personal las claves del género de terro', 18.00, 8, 0, 535, ' 9788497593793', NULL, 0, '2019-05-27', '2019-06-19', 1, 3),
(17, 'Matar a Leonardo Da Vinci', 'mataraleonardo.jpg', '"Meser Leonardo da Vinci tiene un concepto tan herético que no se atiene a ninguna religión y estima más ser filósofo que cristiano. Por lo tanto, la resolución es firme y clara: debemos matar a Leonardo da Vinci".Europa, siglo XIV. Mientras España, Francia e Inglaterra ultiman su unificación, los Estados italianos se ven envueltos en conflictos permanentes por culpa de la religión, el poder y el ansia de expansión territorial. Lo único que les une es el renacimiento cultural de las artes. En la Florencia de los Médici, epicentro de este despliegue artístico, una mano anónima acusa de sodomía a un joven y prometedor Leonardo da Vinci. Durante dos meses será interrogado y torturado hasta que la falta de pruebas lo ponga en libertad. Con la reputación dañada, Leonardo partirá hacia nuevos horizontes para demostrar su talento y apaciguar las secuelas psicológicas provocadas en prisión.¿Quién lo acusó? ¿Con qué motivo? Mientras se debate entre evasión ovenganza Leonardo descubrirá que no todo es lo que parece cuando se trata de alcanzar el éxito.Haciendo gala de un estilo documental exhaustivo y exquisito, fruto de varios años de investigación y de viajes a los escenarios más representativos de la vida del genio, Christian Gálvez construye un thriller histórico, una novela de aventuras en la que se dan cita arte, venganza y pasión. Una obra que atrapa desde las primeras páginas y que cambiará la opinión que hasta ahora se tiene del genio florentino.', 24.00, 15, 0, 294, '9788483656358', NULL, 0, '2019-05-12', '2019-05-31', 1, 6),
(20, 'La historia interminable', 'laistoriainterminable.jpg', '¿Qué es Fantasia? Fantasia es la Historia Interminable. ¿Dónde está escrita esa historia? En un libro de tapas color cobre. ¿Dónde está ese libro? Entonces estaba en el desván de un colegio... Estas son las tres preguntas que formulan los Pensadores Profundos, y las tres sencillas respuestas que reciben de Bastián. Pero para saber realmente lo que es Fantasia hay que leer ese, es decir, este libro. El que tienes en tus manos.\r\n\r\nLa Emperatriz Infantil está mortalmente enferma y su reino corre un grave peligro. La salvación depende de Atreyu, un valiente guerrero de la tribu de los pieles verdes, y Bastián, un niño tímido que lee con pasión un libro mágico. Mil aventuras les llevarán a reunirse y a conocer una fabulosa galería de personajes, y juntos dar forma a una de las grandes creaciones de la literatura de todos los tiempos.', 26.00, 4, 0, 138, '9788420471549', NULL, 0, '2019-05-08', '2019-09-14', 1, 6),
(21, 'Un saco de huesos', 'unsacodehuesos.jpg', '\r\n\r\nLa novela más emocionante e inolvidable de Stephen King. Una historia sobre el sufrimiento por un amor malogrado, un nuevo amor amenazado por secretos del pasado y una inocente niña atrapada entre fuerzas naturales y sobrenaturales.\r\n\r\nCuatro años después de la repentina muerte de su esposa, el novelista Mike Noonan sigue preso de una terrible depresión y de espantosas pesadillas. Por ello decide buscar refugio en su casa de veraneo, Sara Risa.\r\n\r\nAllí conoce a Mattie y a su hija pequeña Kyra, quienes sufren el acoso de Max Devore, el padre de Mattie, un hombre poderoso y sin escrúpulos que trata por todos los medios de conseguir la custodia de su nieta con oscuras intenciones.\r\n\r\nPronto Mike se verá involucrado en el enfrentamiento familiar y, al mismo tiempo, irá descubriendo que Sara Risa se ha convertido en escenario de visitas fantasmales y obsesiones cada vez más abominables.\r\n', 25.00, 7, 0, 60, '9788490326183', NULL, 0, '2019-05-13', '2019-05-24', 1, 3);

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
  `direccion` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `provincia` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `baja` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `usuario`, `correo`, `contraseña`, `nombre`, `apellidos`, `dni`, `direccion`, `codigoPostal`, `provincia`, `baja`, `token`, `tipo`) VALUES
(38, 'cerokun', 'joseluiscortesrapela.jl@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Jose Luis', 'Cortes', '48927740R', 'Calle Praltra 5', 21004, '21', 0, '0', 'cliente'),
(39, 'Cicero', 'serena@libreria.es', '81dc9bdb52d04dc20036dbd8313ed055', 'Serena', 'Argiolas', '48927740r', 'Avd Tolomeo 5', 21005, '41', 0, '0', 'cliente');

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
MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `lineaDePedido`
--
ALTER TABLE `lineaDePedido`
MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lineaDePedido`
--
ALTER TABLE `lineaDePedido`
ADD CONSTRAINT `lineaDePedido_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`),
ADD CONSTRAINT `lineaDePedido_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
