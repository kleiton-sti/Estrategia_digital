# Documentacao — Portal Estrategia Digital (STII)

## Visao geral

Funcionalidade implementada no portal **Estrategia Digital** da Secretaria de Tecnologia da Informacao e Inovacao (STII) de Caraguatatuba. Cobre listagem publica de artigos, visualizacao de conteudo, autenticacao por subrede, painel do tecnico e CRUD completo de artigos com editor WYSIWYG.

---

## Historico de versoes

| Versao | Branch | Descricao |
|---|---|---|
| 1.0.0 | main | Implementacao inicial: artigos, autenticacao, publicacao |
| 1.1.0 | versao-1.1.0 | Campo descricao em categorias; relacao N:N artigo-categoria; redesign dos cards |

---

## 1. Rotas — `routes/web.php`

```
GET  /artigos                     → artigos (publico)
GET  /artigos/{id}                → artigos.conteudo (publico)
GET  /entrar                      → login (restrito a 192.168.11.x)
POST /entrar                      → autenticar
POST /sair                        → sair (auth)
GET  /painel/artigos              → artigos.painel (auth)
GET  /painel/publicar             → artigos.criar (auth)
POST /painel/publicar             → artigos.salvar (auth)
GET  /painel/artigos/{id}/editar  → artigos.editar (auth)
PUT  /painel/artigos/{id}         → artigos.atualizar (auth)
DELETE /painel/artigos/{id}       → artigos.excluir (auth)
POST /painel/upload/imagem        → upload.imagem (auth)
```

---

## 2. Middleware

**`app/Http/Middleware/VerificaRedeStii.php`**
Verifica se o IP da requisicao pertence a subrede `192.168.11.x`.
Retorna `abort(403)` caso contrario.
Registrado com alias `rede.stii` em `bootstrap/app.php`.

---

## 3. Models

**`app/Models/Artigo.php`**
- Usa `SoftDeletes`.
- Fillable: `user_id`, `titulo`, `subtitulo`, `corpo`.
- O campo `categoria_id` foi removido na versao 1.1.0.
- Relacionamentos:
  - `belongsTo(User::class)`
  - `belongsToMany(Categoria::class, 'artigo_categoria')` — relacao N:N

**`app/Models/Categoria.php`**
- Fillable: `nome`, `descricao` (adicionado na versao 1.1.0).
- Relacionamentos:
  - `belongsToMany(Artigo::class, 'artigo_categoria')` — relacao N:N

**`app/Models/User.php`**
- Usa `SoftDeletes`.
- Fillable inclui: `registro`, `nome`, `cpf`, `grupo_id`, `setor_id`.

---

## 4. Services

| Arquivo | Metodos |
|---|---|
| `ProdutosService` | `listarArtigos`, `buscarArtigo`, `listarCategorias` |
| `AutenticacaoService` | `autenticar`, `encerrarSessao` |
| `PublicacaoService` | `publicar`, `atualizar`, `excluir`, `listarPorUsuario` |

Todos os metodos possuem `try/catch` com `Log::error` e `abort(500)`.

Em `publicar` e `atualizar`, as categorias sao sincronizadas via `$artigo->categorias()->sync($dados['categorias'])`.

---

## 5. Controllers

**`ProdutosController`**
- `artigos()` — exibe todos os artigos com relacao `categorias` (plural, N:N).
- `conteudoArtigo($id)` — busca artigo com `categorias` e `user`.

**`AutenticacaoController`**
- `exibirLogin()` → `autenticacao.login`
- `autenticar(AutenticacaoRequest)` → autentica, redireciona para `artigos.painel`
- `sair(Request)` → encerra sessao, redireciona para `home`

**`PublicacaoController`**
- `painel()` → lista artigos do usuario autenticado via `PublicacaoService@listarPorUsuario`
- `criar()` → `publicacao.publicar` com categorias
- `salvar(PublicacaoRequest)` → publica e sincroniza categorias
- `editar($id)` → carrega artigo com `categorias` para preenchimento do formulario
- `atualizar(PublicacaoRequest, $id)` → atualiza e sincroniza categorias
- `excluir($id)` → soft delete, redireciona para painel

---

## 6. FormRequests

**`AutenticacaoRequest`**
- `email`: required, email
- `password`: required, min:6

**`PublicacaoRequest`** (atualizado na versao 1.1.0)
- `titulo`: required, string, max:255
- `subtitulo`: required, string, max:255
- `corpo`: required, string
- `categorias`: required, array, min:1
- `categorias.*`: exists:categorias,id

---

## 7. Migrations

| Arquivo | Descricao |
|---|---|
| `2026_05_08_105725_create_categorias_table.php` | Cria tabela `categorias` com `nome` |
| `2026_05_08_105726_create_artigos_table.php` | Cria tabela `artigos` com `categoria_id` (FK legada) |
| `2026_05_08_123022_alter_users_table.php` | Altera tabela `users` |
| `2026_05_10_000001_add_soft_delete_artigos.php` | Adiciona `deleted_at` em `artigos` |
| `2026_05_11_000001_add_descricao_to_categorias_table.php` | Adiciona coluna `descricao` em `categorias` |
| `2026_05_11_000002_create_artigo_categoria_table.php` | Cria tabela pivot `artigo_categoria` (N:N) |
| `2026_05_11_000003_remove_categoria_id_from_artigos_table.php` | Remove FK `categoria_id` de `artigos` |

> Executar: `php artisan migrate`

---

## 8. Blades

**`layouts/app.blade.php`**
- Menu com botao Entrar (visivel apenas na subrede `192.168.11.x`, usuario nao autenticado).
- Botao Sair exibido quando autenticado (formulario POST `/sair`).
- CSS `artigos.css`, `conteudo-artigo.css`, `publicacao.css` e `login.css` referenciados.

**`produtos/artigos.blade.php`** (redesenhado na versao 1.1.0)
- Modo publico: pills de categoria com filtro JS e grid de cards sem imagem.
- Modo autenticado: cabecalho com nome do usuario, icone e botao Publicar. Lista artigos do proprio usuario.
- Cada card usa `data-categorias` com slugs separados por espaco (N:N).
- Cards sem imagem: topo com gradiente, letra inicial decorativa, badges de categoria, titulo, subtitulo truncado, link "Ler artigo".

**`produtos/conteudo-artigo.blade.php`**
- Perfil do autor (icone + nome + data).
- Botoes de compartilhamento: LinkedIn, Facebook, Twitter/X, WhatsApp, E-mail.
- Badges de categorias multiplas (loop sobre `$artigo->categorias`).
- Titulo, subtitulo, divisor, corpo HTML.
- Botoes editar/excluir via `@include('componentes.acoes-artigo')` apenas para o autor autenticado.

**`publicacao/publicar.blade.php`** (atualizado na versao 1.1.0)
- Selecao de categorias substituida por checkboxes multiplos (`name="categorias[]"`).
- Edicao: categorias ja associadas aparecem marcadas.
- Editor Froala via CDN.

**`autenticacao/login.blade.php`**
- Card escuro, inputs escuros, botao roxo.
- Sem opcao de cadastro ou login social.

**`componentes/acoes-artigo.blade.php`**
- Botoes Editar (link) e Excluir (formulario DELETE com confirmacao JS).

---

## 9. CSS

| Arquivo | Conteudo |
|---|---|
| `artigos.css` | Cards sem imagem, topo gradiente, inicial decorativa, badges N:N, pills, checkboxes de categoria, painel autenticado |
| `conteudo-artigo.css` | Autor, compartilhamento, badges multiplas, titulo/subtitulo/corpo, acoes editar/excluir |
| `publicacao.css` | Card formulario, inputs, tema escuro Froala, botoes publicar/cancelar |
| `login.css` | Card de login, inputs, botao roxo, `.btn-nav-entrar`, `.btn-nav-sair` |

---

## 10. JavaScript

**`public/assets/js/filtro-categoria.js`** (atualizado na versao 1.1.0)
- Cada coluna do grid usa `data-categorias` com lista de slugs separados por espaco.
- Filtro verifica se o slug selecionado esta contido na lista do card (compativel com N:N).

---

## 11. Configuracao necessaria

**`bootstrap/app.php`**
```php
$middleware->alias([
    'rede.stii' => \App\Http\Middleware\VerificaRedeStii::class,
]);
```

**`config/auth.php`**
Guard `web` deve apontar para o model `User` com identificador `email`. O padrao do Laravel ja cobre isso.

---

## 12. Passos para rodar apos o merge

```bash
composer install
php artisan migrate
php artisan db:seed
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 13. Fluxo de uso

**Acesso publico**
1. Usuario acessa `/artigos`.
2. Filtra por categoria via pills.
3. Clica em um card → abre `/artigos/{id}` com conteudo completo e compartilhamento.

**Acesso da rede STII (192.168.11.x)**
1. Botao Entrar aparece no menu.
2. Acessa `/entrar`, informa e-mail e senha.
3. Apos autenticacao, e redirecionado para `/painel/artigos`.
4. Ve seus artigos, botao Publicar e seu nome no topo.
5. Publica em `/painel/publicar` selecionando uma ou mais categorias e usando o editor Froala.
6. Ao visualizar um artigo proprio, ve botoes Editar e Excluir.
7. Editar reabre `/painel/artigos/{id}/editar` com dados preenchidos e categorias marcadas.
8. Excluir realiza soft delete e redireciona para o painel.
9. Sair encerra a sessao e redireciona para Home.

---

## 14. Observacoes

- O campo `nome` e usado nos models/blades. O guard de autenticacao usa `email` + `password`.
- O corpo do artigo e salvo como HTML (gerado pelo Froala) e renderizado com `{!! !!}`. Apenas usuarios internos autenticados podem publicar.
- O middleware `VerificaRedeStii` bloqueia a rota de login para IPs externos. Sessoes ativas continuam validas apos sair da rede ate o logout.
- O Froala CDN usa versao `latest`. Para producao, fixar em uma versao estavel.
- A coluna `descricao` em `categorias` e nullable para compatibilidade com registros existentes.
- A tabela `artigo_categoria` possui indice unico em `(artigo_id, categoria_id)` para evitar duplicatas.
- O metodo `sync` do Eloquent remove categorias desvinculadas automaticamente na edicao.
