-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 08/05/2026 às 08:25
-- Versão do servidor: 10.11.14-MariaDB
-- Versão do PHP: 8.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `carag018_site_estrategia_digital`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acoes_inovacao`
--

CREATE TABLE `acoes_inovacao` (
  `id` int(11) NOT NULL,
  `acao` varchar(255) NOT NULL,
  `status_2024` tinyint(4) NOT NULL,
  `status_2025` tinyint(4) NOT NULL,
  `data_conclusao` date DEFAULT NULL,
  `categoria` enum('servicos_online','participacao_do_cidadao','sistemas_digitais','adequacao_municipal') NOT NULL,
  `realizado_2025` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `acoes_inovacao`
--

INSERT INTO `acoes_inovacao` (`id`, `acao`, `status_2024`, `status_2025`, `data_conclusao`, `categoria`, `realizado_2025`) VALUES
(1, 'Canal de denúncias', 1, 1, NULL, 'servicos_online', 0),
(2, 'Certidões', 1, 1, NULL, 'servicos_online', 0),
(3, 'Consulta a status de protocolos', 1, 1, NULL, 'servicos_online', 0),
(4, 'Consulta de débitos municipais', 1, 1, NULL, 'servicos_online', 0),
(5, 'Emissão de guias/boletos dos débitos municipais', 1, 1, NULL, 'servicos_online', 0),
(6, 'Inscrições em oficinas, cursos, eventos e vagas', 1, 1, NULL, 'servicos_online', 0),
(7, 'Licenças / autorizações', 1, 1, NULL, 'servicos_online', 0),
(8, 'Nota fiscal eletrônica', 1, 1, NULL, 'servicos_online', 0),
(9, 'Ouvidoria', 1, 1, NULL, 'servicos_online', 0),
(10, 'Pesquisa de satisfação em relação aos serviços prestados pela Prefeitura', 1, 1, NULL, 'servicos_online', 0),
(11, 'Solicitação de obras e serviços de urbanização', 1, 1, NULL, 'servicos_online', 0),
(12, 'Solicitação de serviços de zeladoria', 1, 1, NULL, 'servicos_online', 0),
(13, 'Agendamento de consultas na rede pública de saúde', 0, 3, NULL, 'servicos_online', 1),
(14, 'Agendamento de exames em relação a doenças crônicas', 0, 0, NULL, 'servicos_online', 0),
(15, 'Alvarás / licenças de funcionamento', 0, 1, NULL, 'servicos_online', 1),
(16, 'Cadastro de fornecedores', 0, 3, NULL, 'servicos_online', 1),
(17, 'Sensores para monitoramento de área de risco', 1, 1, NULL, 'sistemas_digitais', 0),
(18, 'Sistema de iluminação inteligente', 1, 1, NULL, 'sistemas_digitais', 0),
(19, 'Ônibus municipal com GPS', 0, 1, NULL, 'sistemas_digitais', 1),
(20, 'Bilhete eletrônico transporte público', 0, 1, NULL, 'sistemas_digitais', 1),
(21, 'Centro de controle e operações', 0, 1, NULL, 'sistemas_digitais', 1),
(22, 'Semáforos inteligentes', 0, 0, NULL, 'sistemas_digitais', 0),
(23, 'Consulta pública', 1, 1, NULL, 'participacao_do_cidadao', 0),
(24, 'Enquete', 1, 1, NULL, 'participacao_do_cidadao', 0),
(25, 'Fóruns ou comunidades', 0, 0, NULL, 'participacao_do_cidadao', 0),
(26, 'Votação', 0, 0, NULL, 'participacao_do_cidadao', 0),
(27, 'Área/Dep. TI', 1, 1, NULL, 'adequacao_municipal', 0),
(28, 'Ad. Rede GOV.BR', 0, 1, NULL, 'adequacao_municipal', 1),
(29, 'Assinatura eletrônica', 0, 1, NULL, 'adequacao_municipal', 1),
(30, 'L.G.D.', 0, 1, NULL, 'adequacao_municipal', 1),
(31, 'P.A.I.D', 1, 1, NULL, 'adequacao_municipal', 0),
(32, 'P.A.I.D - Gov. SP.', 0, 0, NULL, 'adequacao_municipal', 0),
(33, 'P.A.I.D - Out. Mun.', 0, 0, NULL, 'adequacao_municipal', 0),
(34, 'PDTI', 0, 1, NULL, 'adequacao_municipal', 1),
(35, 'Processo Administrativo Digital', 0, 1, NULL, 'adequacao_municipal', 1),
(36, 'Serviços Online', 1, 1, NULL, 'adequacao_municipal', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eixos`
--

CREATE TABLE `eixos` (
  `id_eixos` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `eixos`
--

INSERT INTO `eixos` (`id_eixos`, `titulo`, `descricao`) VALUES
(1, 'Gestão Centrada no Munícipe', 'Visa colocar o cidadão no centro da transformação digital, assegurando que os serviços públicos sejam simples, acessíveis e inclusivos, promovendo maior participação social e cidadania digital.'),
(2, 'Gestão Integrada', 'Focado na integração e interoperabilidade dos sistemas municipais, estaduais e federais, assegurando eficiência administrativa, padronização tecnológica e eliminação de redundâncias.'),
(3, 'Gestão Inteligente', 'Promove o uso de dados, inteligência artificial e soluções inovadoras para apoiar a tomada de decisão, ampliar a eficiência da gestão e implementar soluções de cidades inteligentes.'),
(4, 'Gestão Confiável', 'Busca fortalecer a segurança da informação, a governança de dados e a confiabilidade dos sistemas, assegurando conformidade legal e proteção às informações do município e do cidadão.'),
(5, 'Gestão Transparente e Aberta', 'Prioriza a transparência ativa, o acesso a dados públicos e o fortalecimento de canais digitais de participação social, ampliando os mecanismos de controle social e accountability.'),
(6, 'Gestão Eficiente', 'Tem como foco a sustentabilidade e a economicidade no uso da tecnologia, a modernização da infraestrutura e a capacitação dos servidores, consolidando uma gestão pública orientada por resultados.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `entidades`
--

CREATE TABLE `entidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entidade` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupos`
--

CREATE TABLE `grupos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grupo` varchar(50) NOT NULL COMMENT 'Nome do Grupo',
  `observacao` varchar(50) NOT NULL COMMENT 'Observacao',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `grupos_permissoes`
--

CREATE TABLE `grupos_permissoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL,
  `permissao_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `iniciativas`
--

CREATE TABLE `iniciativas` (
  `id_iniciativas` int(11) NOT NULL,
  `id_objetivo` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL,
  `status` enum('Não iniciada','Em execução','Concluída') NOT NULL DEFAULT 'Não iniciada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `iniciativas`
--

INSERT INTO `iniciativas` (`id_iniciativas`, `id_objetivo`, `titulo`, `descricao`, `status`) VALUES
(1, 1, 'Mapear e redesenhar fluxos administrativos para automação', NULL, 'Concluída'),
(2, 1, 'Implantar sistemas de workflow eletrônico na STII', NULL, 'Concluída'),
(3, 1, 'Ampliar a digitalização de processos via software de processo eletrônico e Gestão eletrônica de Documentos (GED e BPM)', NULL, 'Em execução'),
(4, 1, 'Substituir trâmites administrativos realizados em papel por assinaturas digitais e certificação eletrônica', NULL, 'Em execução'),
(5, 1, 'Disponibilizar painéis de acompanhamento', NULL, 'Concluída'),
(6, 2, 'Portal único de serviços digitais', NULL, 'Em execução'),
(7, 2, 'Aprimorar a Jornada do Cidadão nos Serviços Digitais', NULL, 'Em execução'),
(8, 2, 'Acessibilidade digital conforme W3C/WCAG', NULL, 'Concluída'),
(9, 2, 'Criar Programas e Ações de Inclusão Digital e Ampliar Wi-Fi público gratuito em praças, escolas e unidades de saúde', NULL, 'Concluída'),
(10, 2, 'Multicanais de atendimento digital', NULL, 'Em execução'),
(11, 3, 'Plataforma de consultas públicas Online', NULL, 'Em execução'),
(13, 3, 'Plataforma de engajamento em eventos municipais ', NULL, 'Concluída'),
(16, 4, 'Integração a plataformas federais (Gov.br)', NULL, 'Concluída'),
(18, 4, 'Unificação de Cadastro do Cidadão', NULL, 'Em execução'),
(19, 4, 'Eliminação de sistemas redundantes e sobrepostos', NULL, 'Concluída'),
(20, 5, 'Implantar Data Lake municipal', NULL, 'Concluída'),
(21, 5, 'Criar Data Warehouse para relatórios estratégicos', NULL, 'Concluída'),
(22, 5, 'Desenvolver modelos de IA para políticas públicas', NULL, 'Em execução'),
(23, 5, 'Assegurar a interoperabilidade de dados entre divisões', NULL, 'Em execução'),
(26, 6, 'Autenticação única integrada em todos os serviços (SSO onde aplicável)', NULL, 'Em execução'),
(27, 6, 'Plataforma única de comunicação e colaboração interna ', NULL, 'Concluída'),
(28, 6, 'Plataforma única de atendimento e suporte interno ', NULL, 'Concluída'),
(29, 6, 'Definição e gestão de SLAs de TI (serviços e suporte interno)', NULL, 'Concluída'),
(30, 7, 'Criar dashboards estratégicos', NULL, 'Concluída'),
(31, 7, 'Integrar dashboards ao Data Lake', NULL, 'Concluída'),
(32, 7, 'Publicar dashboards de interesse público em portal aberto', NULL, 'Concluída'),
(33, 8, 'Expandir rede de câmeras inteligentes para segurança pública', NULL, 'Em execução'),
(34, 8, 'Implantar sensores IoT para monitoramento ambiental', NULL, 'Em execução'),
(35, 8, 'Integrar soluções de mobilidade urbana inteligente (telemetria, bilhete eletrônico)', NULL, 'Concluída'),
(36, 8, 'Defesa Civil Digital (modernização dos sistemas de prevenção e resposta)', NULL, 'Em execução'),
(37, 8, 'Centro Integrado de Monitoramento e Inteligência – CSI', NULL, 'Concluída'),
(38, 9, 'Editais de inovação govtech', NULL, 'Não iniciada'),
(39, 9, 'Parcerias com universidades/centros de pesquisa (formação e P&D)', NULL, 'Concluída'),
(40, 9, 'Hackathons e desafios de dados públicos', NULL, 'Concluída'),
(41, 9, 'Certificações, Reconhecimentos e Selos de Inovação', NULL, 'Concluída'),
(42, 10, 'Plano municipal de adequação à LGPD', NULL, 'Concluída'),
(43, 10, 'Políticas de cibersegurança alinhadas à ISO/IEC 22300, 27000, 31000 e 38000', NULL, 'Concluída'),
(44, 10, 'Auditorias periódicas de sistemas e dados', NULL, 'Concluída'),
(45, 10, 'Autenticação multifator (MFA) em sistemas críticos', NULL, 'Em execução'),
(46, 10, 'Implantar SOC (Security Operations Center) municipal', NULL, 'Em execução'),
(47, 10, 'Análise de cibersegurança na Prefeitura', NULL, 'Concluída'),
(49, 10, 'Campanhas educativas e conscientização para usuários finais', NULL, 'Concluída'),
(50, 11, 'Matriz de riscos de TI', NULL, 'Concluída'),
(51, 11, 'Plano de continuidade de serviços de TI', NULL, 'Concluída'),
(52, 11, 'Política de redundância e backup inteligente', NULL, 'Concluída'),
(54, 12, 'Mapeamento de todos os sistemas ativos do município', NULL, 'Concluída'),
(55, 12, 'Catálogo único de sistemas e soluções da Prefeitura', NULL, 'Em execução'),
(56, 12, 'Gestão centralizada de ativos de TI', NULL, 'Concluída'),
(57, 12, 'Padronização e digitalização de licitações/contratos de TI', NULL, 'Concluída'),
(58, 13, 'Portal da Transparência', NULL, 'Concluída'),
(59, 14, 'Facilitar o acesso às informações de interesse público', NULL, 'Concluída'),
(60, 15, 'Relatórios públicos de resultados ', NULL, 'Em execução'),
(61, 16, 'Alinhar o PDTI a OCDE, BID e Gartner', NULL, 'Concluída'),
(62, 16, 'Participar de rankings nacionais e internacionais de cidades digitais', NULL, 'Concluída'),
(63, 16, 'Implantar políticas de Smart Cities em Caraguatatuba', NULL, 'Em execução'),
(64, 16, 'Programa de eficiência energética em TI ', NULL, 'Concluída'),
(65, 16, 'Redução de custos e otimização de contratos de TI', NULL, 'Concluída'),
(66, 17, 'Atualizar data center com arquitetura híbrida (nuvem + on-premises)', NULL, 'Em execução'),
(67, 17, 'Redundância de rede e contingência para serviços críticos', NULL, 'Concluída'),
(68, 17, 'Modernização gradual e contínua de softwares legados', NULL, 'Concluída'),
(69, 17, 'Reestruturação de infraestrutura e serviços de TI (diretórios, servidores, redes, segurança)', NULL, 'Concluída'),
(70, 18, 'Escola Municipal de Governo Digital (Capacitação contínua)', NULL, 'Concluída'),
(71, 18, 'Trilhas de capacitação em LGPD, segurança e inovação', NULL, 'Concluída'),
(72, 18, 'Formação de agentes de inovação nas secretarias', NULL, 'Concluída'),
(73, 18, 'Programas de certificação digital para servidores estratégicos', NULL, 'Concluída'),
(74, 18, 'Programas de intraempreendedorismo público', NULL, 'Concluída'),
(75, 18, 'Premiações e reconhecimento a práticas inovadoras', NULL, 'Concluída'),
(76, 18, 'Blueprint tecnológico municipal atualizado anualmente', NULL, 'Concluída'),
(77, 18, 'Avaliar aquisições de tecnologia conforme diretrizes do PDTI', NULL, 'Concluída'),
(78, 18, 'Checklist obrigatório de interoperabilidade e integração', NULL, 'Concluída'),
(79, 18, 'Modernização do call center e do atendimento municipal (omnicanal)', NULL, 'Concluída'),
(80, 18, 'Atendimento e capacitação de equipes de TI', NULL, 'Concluída'),
(81, 18, 'Integração com Políticas de Sustentabilidade e ODS', NULL, 'Concluída'),
(82, 18, 'Gestão de Informação e Conhecimento', NULL, 'Concluída'),
(83, 18, 'Inventário de Habilidades', NULL, 'Concluída'),
(84, 8, 'API Gov Estado - Muralha Paulista', NULL, 'Concluída'),
(86, 7, 'Criar dashboards gerenciais', NULL, 'Concluída'),
(87, 7, 'Criar dashboards operacionais', NULL, 'Concluída'),
(88, 8, 'API Gov Federal - Córtex', NULL, 'Em execução'),
(89, 13, 'Regulamentar a Política Municipal de Dados abertos', NULL, 'Concluída'),
(90, 13, 'Implementar Portal Municipal de Dados Abertos', NULL, 'Em execução');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `message` text NOT NULL,
  `entity_type` varchar(50) DEFAULT NULL,
  `entity_id` int(11) DEFAULT 0,
  `context` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_04_23_224239_create_entidades_table', 1),
(4, '2025_04_23_224254_create_unidades_table', 1),
(5, '2025_04_23_224302_create_setores_table', 1),
(6, '2025_04_23_224622_create_grupos_table', 1),
(7, '2025_04_23_224632_create_permissoes_table', 1),
(8, '2025_04_23_224717_create_grupos_permissoes_table', 1),
(9, '2025_04_23_224718_create_users_table', 1),
(10, '2025_04_24_185506_create_logs_table', 1),
(11, '2025_05_19_133848_tipos_ato_table', 1),
(12, '2025_05_19_133907_atos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `objetivos`
--

CREATE TABLE `objetivos` (
  `id_objetivo` int(11) NOT NULL,
  `id_eixos` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `objetivos`
--

INSERT INTO `objetivos` (`id_objetivo`, `id_eixos`, `titulo`, `descricao`) VALUES
(1, 1, 'Digitalizar e automatizar processos administrativos', 'Contribui para a ODS 10 e ODS 16, promovendo inclusão digital, participação social e cidadania digital.'),
(2, 1, 'Ampliar o acesso da população aos serviços digitais', 'Contribui para a ODS 10 e ODS 16, promovendo inclusão digital, participação social e cidadania digital.'),
(3, 1, 'Fortalecer a cidadania digital e a participação do munícipe', 'Contribui para a ODS 10 e ODS 16, promovendo inclusão digital, participação social e cidadania digital.'),
(4, 2, 'Integrar e interoperar sistemas municipais', 'Reforça o ODS 9 e ODS 16, promovendo interoperabilidade, eficiência e padronização tecnológica.'),
(5, 2, 'Estruturar cadastros referenciais municipais', 'Reforça o ODS 9 e ODS 16, promovendo interoperabilidade, eficiência e padronização tecnológica.'),
(6, 2, 'Compartilhar plataformas e ferramentas entre secretarias', 'Reforça o ODS 9 e ODS 16, promovendo interoperabilidade, eficiência e padronização tecnológica.'),
(7, 3, 'Utilizar dados e inteligência artificial na formulação de políticas públicas', 'Está alinhado ao ODS 9, incentivando inovação, uso de dados e cidades inteligentes.'),
(8, 3, 'Implementar soluções de cidades inteligentes', 'Está alinhado ao ODS 9, incentivando inovação, uso de dados e cidades inteligentes.'),
(9, 3, 'Estimular a inovação aberta e o ecossistema local', 'Está alinhado ao ODS 9, incentivando inovação, uso de dados e cidades inteligentes.'),
(10, 4, 'Assegurar a segurança da informação e cibersegurança', 'Contribui para o ODS 16, sustentando governança, conformidade legal e segurança da informação.'),
(11, 4, 'Fortalecer a governança de dados e conformidade legal', 'Contribui para o ODS 16, sustentando governança, conformidade legal e segurança da informação.'),
(12, 4, 'Assegurar confiabilidade e qualidade da informação', 'Contribui para o ODS 16, sustentando governança, conformidade legal e segurança da informação.'),
(13, 5, 'Ampliar a transparência ativa e os dados abertos', 'Alinha-se ao ODS 16, fortalecendo transparência e participação social.'),
(14, 5, 'Fortalecer a participação social por meios digitais', 'Alinha-se ao ODS 16, fortalecendo transparência e participação social.'),
(15, 5, 'Fomentar práticas de gestão transparente e de prestação de contas à sociedade', 'Alinha-se ao ODS 16, fortalecendo transparência e participação social.'),
(16, 6, 'Assegurar economicidade e sustentabilidade tecnológica', 'Reforça ODS 9 e ODS 12, promovendo eficiência, sustentabilidade tecnológica e gestão orientada por resultados.'),
(17, 6, 'Modernizar a infraestrutura tecnológica e conectividade', 'Reforça ODS 9 e ODS 12, promovendo eficiência, sustentabilidade tecnológica e gestão orientada por resultados.'),
(18, 6, 'Fortalecer a gestão por resultados e capacitação', 'Reforça ODS 9 e ODS 12, promovendo eficiência, sustentabilidade tecnológica e gestão orientada por resultados.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome_permissao` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `regulamentacoes`
--

CREATE TABLE `regulamentacoes` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `publicado_em` date DEFAULT NULL,
  `pendente` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `regulamentacoes`
--

INSERT INTO `regulamentacoes` (`id`, `titulo`, `descricao`, `link`, `publicado_em`, `pendente`) VALUES
(1, 'Decreto nº 2.283, de 24 de julho de 2025', 'Aplica a Lei Federal nº 14.129/2021 no âmbito da Administração Pública de Caraguatatuba.', 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D22832025.html', '2025-08-05', 1),
(2, 'Decreto nº 2.333, de 11 de setembro de 2025', 'Cria grupo de trabalho para adequação da Administração à Lei Geral de Proteção de Dados (LGPD).', 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23332025.html', '2025-09-19', 1),
(3, 'Decreto nº 2.353, de 08 de outubro de 2025', 'Altera o decreto do grupo de trabalho sobre adequação da Administração à Lei Geral de Proteção de Dados.', 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23532025.html', '2025-10-10', 1),
(4, 'Decreto nº 2.363, de 14 de outubro de 2025', 'Nomeia o DPO titular e suplente', 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23632025.html', '2025-10-21', 0),
(5, 'Decreto 2.394, de 25 de Novembro de 2025', 'Regula a utilização de processos eletrônicos no município', 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/d23942025.html', '2025-12-03', 0),
(6, 'Decreto 2.368, de 22 de Outubro de 2025', 'Instituição da Política Municipal de Dados Abertos', 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/D23682025.html', '2025-12-08', 0),
(7, 'Decreto 2.396, de 01 de Dezembro de 2025', 'Instituição do Plano Diretor de Tecnologia da Informação do Município de Caraguatatuba', 'https://caraguatatuba.legislacaocompilada.com.br/Arquivo/Documents/legislacao/html/d23962025.html', '2025-12-03', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `roadmap`
--

CREATE TABLE `roadmap` (
  `id` int(11) NOT NULL,
  `acao` longtext NOT NULL,
  `status` enum('entregue_recentemente','em_andamento','explorando') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `eixo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Despejando dados para a tabela `roadmap`
--

INSERT INTO `roadmap` (`id`, `acao`, `status`, `created_at`, `updated_at`, `deleted_at`, `eixo_id`) VALUES
(38, 'Entregue a primeira versão do software do Fundo Social, para testes de aderência em relação à rotina do setor.', 'entregue_recentemente', NULL, NULL, NULL, 2),
(40, 'Adesão à rede Gov BR, posibilitando integração de sistemas municipais com o governo federal.', 'entregue_recentemente', NULL, NULL, NULL, 2),
(41, 'Integração da plataforma e-SUS com a rede Gov BR, possibilitando acesso com login único.', 'entregue_recentemente', NULL, NULL, NULL, 2),
(42, 'Desenvolvimento de site  “Estratégia Digital”, dando transparência e prestando contas das ações vinculadas ao uso de tecnologia no município.', 'em_andamento', NULL, NULL, NULL, 5),
(43, 'Disponibilização de agendamento de consultas através do aplicativo “Meu SUS Digital”.', 'em_andamento', NULL, NULL, NULL, 1),
(44, 'Readequação site Empreenda Caraguatatuba para nova edição do evento', 'em_andamento', NULL, NULL, NULL, 3),
(46, 'Desenvolvimento de Software para a Secretaria dos Direitos da Pessoa com Deficiência e Idoso, com o intuito de modernizar e amparar a operação da Secretaria', 'explorando', NULL, NULL, NULL, 2),
(47, 'Elaboração LOA e PPA 2026', 'entregue_recentemente', NULL, NULL, NULL, 6),
(48, 'Decreto 2353 - Altera Grupo de Trabalho LGPD', 'entregue_recentemente', NULL, NULL, NULL, 4),
(49, 'Estruturação interna do Grupo de Trabalho  - LGPD', 'em_andamento', NULL, NULL, NULL, 4),
(50, 'Processo licitatório para renovação/complementação do parque de máquinas da Prefeitura', 'em_andamento', NULL, NULL, NULL, 4),
(51, 'Processo licitatório para implantação do CSI - Centro de Segurança e Inteligência', 'em_andamento', NULL, NULL, NULL, 2),
(52, 'Processo licitatório para ampliação e melhorias da Central 156, incluindo os serviços de 199 e 153', 'em_andamento', NULL, NULL, NULL, 2),
(53, 'Elaboração da política de dados abertos', 'em_andamento', NULL, NULL, NULL, 5),
(54, 'Regulamentação da Assinatura Digital', 'em_andamento', NULL, NULL, NULL, 4),
(55, 'Regulamentação de Processos Digitais', 'em_andamento', NULL, NULL, NULL, 6),
(56, 'Implantação do Digitaliza Caraguá, criando locais públicos para acesso à internet em ambiente acadêmico', 'em_andamento', NULL, NULL, NULL, 1),
(57, 'Adequação ao PROCEL - Programa Nacional de Conservação de Energia Elétrica', 'em_andamento', NULL, NULL, NULL, 6),
(58, 'Implantação de Software no Conselho Tutelar', 'em_andamento', NULL, NULL, NULL, 2),
(59, 'Implantação de Gestão à Vista, com dashboards de informações da operação da Secretaria de Tecnologia', 'em_andamento', NULL, NULL, NULL, 3),
(60, 'Implantação do Conecta, plataforma de comunicação corporativa', 'entregue_recentemente', NULL, NULL, NULL, 6),
(61, 'Implantação do Resolve STII, facilitando o acesso das outras Secretarias à STII e proporcionando melhor visão do fluxo de demandas', 'entregue_recentemente', NULL, NULL, NULL, 6),
(62, 'Disponibilização do Cadastro de Fornecedores Online, atendendo demanda do TCE e democratizando o acesso dos fornecedores', 'em_andamento', NULL, NULL, NULL, 5),
(63, 'Automações de alertas de incidentes no ambiente de T.I, possibilitando monitoramento ativo e resposta ágil', 'explorando', NULL, NULL, NULL, 3),
(64, 'Elaboração de projeto de monitoramente interno das unidades da Secretaria de Educação', 'em_andamento', NULL, NULL, NULL, 1),
(65, 'Estruturação do evento Ação Cidadania', 'em_andamento', NULL, NULL, NULL, 1),
(66, 'Melhorias nos fluxos internos da STII, através da cultura de dados', 'entregue_recentemente', NULL, NULL, NULL, 6),
(67, 'Regulamentação da Lei do Governo Digital', 'entregue_recentemente', NULL, NULL, NULL, 1),
(68, 'Criação de Data Lake municipal, possibilitando centralização e integração dos dados, além do suporte à tomada de decisão', 'explorando', NULL, NULL, NULL, 3),
(69, 'Regulamentação da LGPD', 'em_andamento', NULL, NULL, NULL, 4),
(70, 'Desenvolvimento de Software para publicação do Diário Oficial, facilitando o acesso da população à informação', 'entregue_recentemente', NULL, NULL, NULL, 1),
(71, 'Desenvolvimento de Software para votação do Caraguá Agosto 2025, facilitando e dando transparência ao processo de votação', 'entregue_recentemente', NULL, NULL, NULL, 1),
(72, 'Autenticação única e integrada em todos os serviços digitais', 'em_andamento', NULL, NULL, NULL, 2),
(73, 'Unificação de cadastros de cidadãos e empresas', 'em_andamento', NULL, NULL, NULL, 2),
(74, 'Campanhas educativas e conscientização para usuários finais', 'em_andamento', NULL, NULL, NULL, 4),
(75, 'Autenticação multifator (MFA) em sistemas críticos', 'em_andamento', NULL, NULL, NULL, 4),
(76, 'Políticas de cibersegurança alinhadas à ISO/IEC 22300, 27000, 31000 e 38000.', 'em_andamento', NULL, NULL, NULL, 4),
(77, 'Criação de ambiente Sandbox para homologação e validação das soluções tecnológicas', 'explorando', NULL, NULL, NULL, 4),
(78, 'Política de redundância e backup inteligente', 'em_andamento', NULL, NULL, NULL, 4),
(79, 'Integração da ouvidoria digital ao portal único', 'explorando', NULL, NULL, NULL, 1),
(80, 'Evento #ElasTech, promovendo inclusão das alunas da rede municipal ao mercado de tecnologia', 'entregue_recentemente', NULL, NULL, NULL, 3),
(81, 'Gestão centralizada de ativos de TI', 'entregue_recentemente', NULL, NULL, NULL, 4),
(82, 'Matriz de riscos de TI', 'entregue_recentemente', NULL, NULL, NULL, 4),
(83, 'Relatórios públicos de resultados ', 'explorando', NULL, NULL, NULL, 5),
(84, 'Digitalização dos processos de aditamentos de viagens, promovendo economia nos trâmites das Secretarias', 'explorando', NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `setores`
--

CREATE TABLE `setores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `setor` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `unidade_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Chave estrangeira que faz a relacao com a tabela unidades'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `unidades`
--

CREATE TABLE `unidades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unidade` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `entidade_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Chave estrangeira que faz a relacao com a tabela entidades'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `registro` varchar(191) NOT NULL,
  `nome` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `cpf` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `grupo_id` bigint(20) UNSIGNED NOT NULL,
  `setor_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acoes_inovacao`
--
ALTER TABLE `acoes_inovacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices de tabela `eixos`
--
ALTER TABLE `eixos`
  ADD PRIMARY KEY (`id_eixos`);

--
-- Índices de tabela `entidades`
--
ALTER TABLE `entidades`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `grupos_permissoes`
--
ALTER TABLE `grupos_permissoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grupos_permissoes_grupo_id_foreign` (`grupo_id`),
  ADD KEY `grupos_permissoes_permissao_id_foreign` (`permissao_id`);

--
-- Índices de tabela `iniciativas`
--
ALTER TABLE `iniciativas`
  ADD PRIMARY KEY (`id_iniciativas`),
  ADD KEY `fk_iniciativas_objetivos_idx` (`id_objetivo`);

--
-- Índices de tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices de tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `objetivos`
--
ALTER TABLE `objetivos`
  ADD PRIMARY KEY (`id_objetivo`),
  ADD KEY `fk_objetivos_principios_idx` (`id_eixos`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissoes_nome_permissao_unique` (`nome_permissao`);

--
-- Índices de tabela `regulamentacoes`
--
ALTER TABLE `regulamentacoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `roadmap`
--
ALTER TABLE `roadmap`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eixo_id_idx` (`eixo_id`);

--
-- Índices de tabela `setores`
--
ALTER TABLE `setores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `setores_unidade_id_foreign` (`unidade_id`);

--
-- Índices de tabela `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unidades_entidade_id_foreign` (`entidade_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_cpf_unique` (`cpf`),
  ADD KEY `users_grupo_id_foreign` (`grupo_id`),
  ADD KEY `users_setor_id_foreign` (`setor_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `eixos`
--
ALTER TABLE `eixos`
  MODIFY `id_eixos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `entidades`
--
ALTER TABLE `entidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `grupos_permissoes`
--
ALTER TABLE `grupos_permissoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `iniciativas`
--
ALTER TABLE `iniciativas`
  MODIFY `id_iniciativas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `objetivos`
--
ALTER TABLE `objetivos`
  MODIFY `id_objetivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `regulamentacoes`
--
ALTER TABLE `regulamentacoes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `roadmap`
--
ALTER TABLE `roadmap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `setores`
--
ALTER TABLE `setores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `grupos_permissoes`
--
ALTER TABLE `grupos_permissoes`
  ADD CONSTRAINT `grupos_permissoes_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `grupos_permissoes_permissao_id_foreign` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`);

--
-- Restrições para tabelas `iniciativas`
--
ALTER TABLE `iniciativas`
  ADD CONSTRAINT `fk_iniciativas_objetivos` FOREIGN KEY (`id_objetivo`) REFERENCES `objetivos` (`id_objetivo`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `objetivos`
--
ALTER TABLE `objetivos`
  ADD CONSTRAINT `fk_objetivos_principios` FOREIGN KEY (`id_eixos`) REFERENCES `eixos` (`id_eixos`) ON UPDATE CASCADE;

--
-- Restrições para tabelas `roadmap`
--
ALTER TABLE `roadmap`
  ADD CONSTRAINT `eixo_id` FOREIGN KEY (`eixo_id`) REFERENCES `eixos` (`id_eixos`);

--
-- Restrições para tabelas `setores`
--
ALTER TABLE `setores`
  ADD CONSTRAINT `setores_unidade_id_foreign` FOREIGN KEY (`unidade_id`) REFERENCES `unidades` (`id`);

--
-- Restrições para tabelas `unidades`
--
ALTER TABLE `unidades`
  ADD CONSTRAINT `unidades_entidade_id_foreign` FOREIGN KEY (`entidade_id`) REFERENCES `entidades` (`id`);

--
-- Restrições para tabelas `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_grupo_id_foreign` FOREIGN KEY (`grupo_id`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `users_setor_id_foreign` FOREIGN KEY (`setor_id`) REFERENCES `setores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
