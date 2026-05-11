# Documentação — Implementação: Artigos, Autenticação e Publicação

## Visão geral

Funcionalidade implementada no portal **Estratégia Digital** da Secretaria de Tecnologia da Informação e Inovação (STII) de Caraguatatuba. Cobre listagem pública de artigos, visualização de conteúdo, autenticação por subrede, painel do técnico e CRUD completo de artigos com editor WYSIWYG.

---

## 1. Arquivos criados / modificados

### Rotas — `routes/web.php`
- Rota `/artigos` pública substituída pela rota nomeada `artigos` apontando para `ProdutosController@artigos`.
- Rota `/artigos/{id}` pública para `ProdutosController@conteudoArtigo`, nomeada `artigos.conteudo`.
- Grupo `middleware('rede.stii')` protege as rotas de login (`/entrar`).
- Grupo `middleware('auth')` protege o painel e o CRUD de publicação.
- Rota `POST /sair` com middleware `auth` para encerrar sessão.

```
GET  /artigos                     → artigos (público)
GET  /artigos/{id}                → artigos.conteudo (público)
GET  /entrar                      → login (restrito à 192.168.11.x)
POST /entrar                      → autenticar
POST /sair                        → sair (auth)
GET  /painel/artigos              → artigos.painel (auth)
GET  /painel/publicar             → artigos.criar (auth)
POST /painel/publicar             → artigos.salvar (auth)
GET  /painel/artigos/{id}/editar  → artigos.editar (auth)
PUT  /painel/artigos/{id}         → artigos.atualizar (auth)
DELETE /painel/artigos/{id}       → artigos.excluir (auth)
```

---

### Middleware — `app/Http/Middleware/VerificaRedeStii.php`
Verifica se o IP da requisição pertence à subrede `192.168.11.x`. Retorna `abort(403)` caso contrário. Registrado com o alias `rede.stii` em `bootstrap/app.php`.

---

### Models

**`app/Models/Artigo.php`**
- Adicionado `SoftDeletes`.
- Relacionamentos: `belongsTo(User)` e `belongsTo(Categoria, 'categoria_id')`.
- Campo `categoria` (string simples) removido do `$fillable`; mantido apenas `categoria_id`.

**`app/Models/User.php`**
- Adicionado `SoftDeletes`.
- `$fillable` expandido para incluir `registro`, `nome`, `cpf`, `grupo_id`, `setor_id` (compatível com o seeder existente).

---

### Services

| Arquivo | Responsabilidade |
|---|---|
| `app/Services/ProdutosService.php` | `listarArtigos`, `buscarArtigo`, `listarCategorias` |
| `app/Services/AutenticacaoService.php` | `autenticar` (Auth::attempt), `encerrarSessao` |
| `app/Services/PublicacaoService.php` | `publicar`, `atualizar`, `excluir` (soft delete), `artigosPorUsuario` |

Todos os métodos possuem `try/catch` com `Log::error` e `abort(500)`.

---

### Controllers

**`app/Http/Controllers/ProdutosController.php`**
- Injeta `ProdutosService`.
- Métodos adicionados: `artigos()` → view `produtos.artigos`; `conteudoArtigo($id)` → view `produtos.conteudo-artigo`.
- Métodos existentes (`numeros`, `allHands`) mantidos com `try/catch`.

**`app/Http/Controllers/AutenticacaoController.php`** *(novo)*
- Injeta `AutenticacaoService`.
- `exibirLogin()` → view `autenticacao.login`.
- `autenticar(AutenticacaoRequest)` → valida, autentica, redireciona para `artigos.painel`.
- `sair(Request)` → encerra sessão, redireciona para `home`.

**`app/Http/Controllers/PublicacaoController.php`** *(novo)*
- Injeta `PublicacaoService` e `ProdutosService`.
- `painel()` → lista artigos do usuário autenticado → view `produtos.artigos`.
- `criar()` → view `publicacao.publicar` com categorias.
- `salvar(PublicacaoRequest)` → publica e redireciona.
- `editar($id)` → abre `produtos.conteudo-artigo` com dados preenchidos.
- `atualizar(PublicacaoRequest, $id)` → atualiza e redireciona.
- `excluir($id)` → soft delete e redireciona para painel.

---

### FormRequests

**`app/Http/Requests/AutenticacaoRequest.php`**
- Campos: `email` (required, email), `password` (required, min:6).

**`app/Http/Requests/PublicacaoRequest.php`**
- Campos: `titulo`, `subtitulo`, `corpo` (required, string), `categoria_id` (required, exists:categorias,id).

---

## 2. Blades

### `resources/views/layouts/app.blade.php` (modificado)
- Item **Artigos** adicionado no menu principal (ao lado de Roadmap).
- Botão **Entrar** exibido apenas quando o IP é da subrede `192.168.11.x` e o usuário não está autenticado.
- Botão **Sair** exibido quando autenticado (formulário POST para `/sair`).
- CSS `conteudo-artigo.css`, `publicacao.css` e `login.css` referenciados (já estavam presentes; confirmados).

### `resources/views/produtos/artigos.blade.php` (reescrita)
- **Modo público:** exibe pills de categoria com filtro JS e grid de cards clicáveis.
- **Modo autenticado:** exibe cabeçalho com nome do usuário, ícone e botão "Publicar". Filtra artigos do usuário. Exibe "Nada publicado ainda." quando vazio.

### `resources/views/produtos/conteudo-artigo.blade.php` (novo)
Ordem de exibição no `<main>`:
1. Perfil do autor: ícone `bi-person-circle` + nome + data de publicação.
2. Redes sociais para compartilhamento: LinkedIn, Facebook, Twitter/X, WhatsApp, E-mail.
3. Badge de categoria.
4. Título (`<h1>`), subtítulo, divisor horizontal.
5. Corpo do artigo (renderizado com `{!! !!}` para suportar HTML do Froala).
6. Ações (editar / excluir) via `@include('componentes.acoes-artigo')` — exibidas apenas para o autor autenticado.

### `resources/views/autenticacao/login.blade.php` (novo)
Design inspirado na imagem de referência (card escuro, fundo `#12132b`, inputs `#1e1f3a`, botão roxo `#a78bfa`). Sem opção de cadastro ou login social.

### `resources/views/publicacao/publicar.blade.php` (novo)
- Formulário com campos: categoria (select), título, subtítulo, corpo.
- Editor Froala carregado via CDN (conforme documentação oficial).
- Reutilizado para edição: quando `$artigo` existe, preenche os campos e usa método `PUT`.
- JS do Froala empilhado via `@push('scripts')`.

### `resources/views/componentes/acoes-artigo.blade.php` (novo)
Componente com botões **Editar** (link) e **Excluir** (formulário DELETE com confirmação JS). Incluído via `@include` em `conteudo-artigo.blade.php`.

---

## 3. CSS

| Arquivo | Conteúdo |
|---|---|
| `public/assets/css/login.css` | Card de login, inputs, botão roxo, `.btn-nav-entrar`, `.btn-nav-sair` |
| `public/assets/css/conteudo-artigo.css` | Autor, compartilhamento, badge, título/subtítulo/corpo, ações editar/excluir |
| `public/assets/css/publicacao.css` | Card do formulário, inputs, select, adaptação do tema Froala (escuro), botões publicar/cancelar |
| `public/assets/css/artigos.css` | Atualizado com `.artigos-header-auth`, `.btn-publicar`, `.artigos-vazio`, `.artigo-card-link` |

---

## 4. Migrations

| Arquivo | Alteração |
|---|---|
| `2026_05_10_000001_add_soft_delete_artigos.php` | Adiciona `deleted_at` na tabela `artigos` |
| `2026_05_10_000002_add_soft_delete_users.php` | Adiciona `deleted_at` na tabela `users` |

> Executar: `php artisan migrate`

---

## 5. Configuração necessária

### `bootstrap/app.php`
Alias do middleware registrado:
```php
$middleware->alias([
    'rede.stii' => \App\Http\Middleware\VerificaRedeStii::class,
]);
```

### `config/auth.php`
Verificar se o guard `web` aponta para o model `User` e usa o campo `email` como identificador. O padrão do Laravel já cobre isso.

---

## 6. Passos para rodar após o merge

```bash
# Instalar dependências (se necessário)
composer install

# Rodar migrations
php artisan migrate

# Popular banco (se necessário)
php artisan db:seed

# Limpar caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 7. Fluxo de uso

### Acesso público
1. Qualquer usuário acessa `/artigos`.
2. Filtra por categoria via pills.
3. Clica em um card → abre `/artigos/{id}` com conteúdo completo e opções de compartilhamento.

### Acesso da rede STII (192.168.11.x)
1. Botão **Entrar** aparece no menu.
2. Acessa `/entrar`, informa e-mail e senha.
3. Após autenticação, é redirecionado para `/painel/artigos`.
4. Vê seus artigos, botão **Publicar** e seu nome no topo.
5. Publica em `/painel/publicar` com editor Froala.
6. Ao visualizar um artigo próprio (`/artigos/{id}`), vê botões **Editar** e **Excluir**.
7. Editar reabre `/painel/artigos/{id}/editar` com dados preenchidos.
8. Excluir realiza soft delete e redireciona para o painel.
9. **Sair** encerra a sessão e redireciona para Home.

---

## 8. Observações

- O campo `nome` é usado nos models/blades (compatível com o seeder). O guard de autenticação continua usando `email` + `password`.
- O corpo do artigo é salvo como HTML (gerado pelo Froala) e renderizado com `{!! !!}`. Certifique-se de que apenas usuários internos autenticados possam publicar para evitar XSS.
- O middleware `VerificaRedeStii` bloqueia a exibição da rota de login para IPs externos. Usuários já autenticados que saem da rede continuam com sessão ativa até fazer logout.
- O Froala CDN utiliza a versão `latest`. Para produção, fixar em uma versão estável.
