CREATE SCHEMA `projeto` ;
USE `projeto`;

--
-- Table structure for table `Fornecedores`
--

DROP TABLE IF EXISTS `Fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Fornecedores` (
  `IdFornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `RazaoSocial` varchar(100) NOT NULL,
  `NomeFantasia` varchar(100) NOT NULL,
  `CNPJ` varchar(22) NOT NULL COMMENT '(11) 00000-0000',
  `NomeResponsavel` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telefone` varchar(15) NOT NULL,
  `Endereco` varchar(100) NOT NULL,
  `Numero` varchar(8) NOT NULL,
  `Complemento` varchar(45) DEFAULT NULL,
  `Bairro` varchar(100) NOT NULL,
  `Cidade` varchar(100) NOT NULL,
  `Estado` varchar(2) NOT NULL,
  `CEP` varchar(9) NOT NULL,
  `Ativo` tinyint(1) NOT NULL DEFAULT '1',
  `Deletado` tinyint(1) NOT NULL DEFAULT '0',
  `DataCriacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataAtualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdFornecedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Pedidos`
--

DROP TABLE IF EXISTS `Pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pedidos` (
  `IdPedido` int(11) NOT NULL AUTO_INCREMENT,
  `IdFornecedor` int(11) NOT NULL,
  `Observacoes` text NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = ativo\\n2 = finalizado	',
  `Deletado` tinyint(1) NOT NULL DEFAULT '0',
  `DataCriacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataAtualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdPedido`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `PedidosProdutos`
--

DROP TABLE IF EXISTS `PedidosProdutos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PedidosProdutos` (
  `IdPedido` int(11) NOT NULL,
  `IdProduto` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Produtos`
--

DROP TABLE IF EXISTS `Produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Produtos` (
  `IdProduto` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `CodigoDeBarras` varchar(30) NOT NULL,
  `Descricao` text NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `Ativo` tinyint(1) NOT NULL DEFAULT '1',
  `Deletado` tinyint(1) NOT NULL DEFAULT '0',
  `DataCriacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataAtualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdProduto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Tokens`
--

DROP TABLE IF EXISTS `Tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Tokens` (
  `IdToken` int(11) NOT NULL AUTO_INCREMENT,
  `Token` varchar(50) NOT NULL,
  `Ativo` tinyint(1) NOT NULL DEFAULT '1',
  `Deletado` tinyint(1) NOT NULL DEFAULT '0',
  `DataCriacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataAtualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdToken`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Usuarios`
--

DROP TABLE IF EXISTS `Usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `Ativo` tinyint(1) NOT NULL DEFAULT '1',
  `DataCriacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataAtualizacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
