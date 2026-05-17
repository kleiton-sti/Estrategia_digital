
---

## 15. Ajustes visuais — versao-1.1.x (frontend)

### 15.1 Sistema de espacamento unificado

Introduzidas tres variaveis CSS globais em `main.css` (`:root`):

```css
--section-padding-y: 80px;   /* padding vertical de todas as secoes */
--section-gap: 60px;         /* reservado para gaps entre blocos internos */
--title-gap: 40px;           /* padding-bottom dos blocos de titulo */
```

A regra `section { padding: var(--section-padding-y) 0; }` substitui o valor fixo anterior de `250px 0 160px`, tornando todas as secoes uniformes e menores — permitindo que o inicio da secao seguinte fique visivel no viewport.

`section#hero` usa `min-height: 92dvh` (era `100dvh`) para o mesmo efeito no hero.

No `responsive.css`, as variaveis sao sobrescritas por breakpoint:
- `768px`: `--section-padding-y: 60px`, `--title-gap: 32px`
- `576px`: `--section-padding-y: 50px`, `--title-gap: 28px`

### 15.2 Tipografia padronizada

Todos os titulos de secao (`h1`, `h2`, `.section-title h2`, `.section-title-obj h2`, `.section-titulo h1/h2`) agora compartilham:
- `font-family: var(--heading-font)` (Quicksand)
- `font-size: 1.8rem`
- `font-weight: 700`
- `color: rgba(232, 231, 247, 0.73)` — mesma opacidade do hero

Paragrafos descritivos padrao:
- `font-size: 0.95rem`
- `color: color-mix(in srgb, var(--default-color), transparent 30%)`
- `line-height: 1.65`

Afeta: `main.css`, `principios.css`, `objetivos.css`, `roadmap.css`, `regulamentacoes.css`.

### 15.3 Hero — cerebro alinhado ao topo do texto

A coluna do cerebro usava `align-items: center` na row. Alterado para `align-items: flex-start` em `home.blade.php` e `.hero .hero-visual` passa a usar `align-items: flex-start` em `hero.css`.

### 15.4 Hero — numeros lado a lado em telas grandes

`.hero .hero-stats` alterado de `gap: 9rem` com `flex-wrap: wrap` para:
- `flex-direction: row`
- `flex-wrap: nowrap`
- `gap: 2.5rem`

Em telas menores que 992px o `responsive.css` reintroduz `flex-wrap: wrap` com itens em pares (`flex: 1 1 45%`).

### 15.5 Arquivos CSS alterados

| Arquivo | Mudancas principais |
|---|---|
| `main.css` | Variaveis de espacamento, tipografia global unificada, `section` padding |
| `hero.css` | Stats lado a lado, visual `align-items: flex-start`, tamanhos reduzidos |
| `principios.css` | Tipografia Quicksand, tamanhos de fonte, padding cards |
| `objetivos.css` | Titulos, paragrafos, filtros — fontes e cores padronizadas |
| `roadmap.css` | Titulos, status, itens de acao — fontes e cores padronizadas |
| `regulamentacoes.css` | Timeline — fundo `surface-color`, tipografia padronizada |
| `responsive.css` | Variaveis por breakpoint, stats em pares no mobile/tablet |

### 15.6 Blade alterada

`home.blade.php` — `align-items-center` removido da row do hero, substituido por `align-items-start`.
