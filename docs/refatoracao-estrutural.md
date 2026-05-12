# Refatoração estrutural — Back-end e Front-end

**Data:** maio de 2026

---

## Back-end

### Services criados

| Service | Responsabilidade |
|---|---|
| `EixoService` | `dadosHome()` — carrega eixos com objetivos/iniciativas e calcula totais e ícones; `dadosEixo($id)` — carrega um eixo com objetivosData, sidebar de contagens e mapa ODS |
| `RoadmapService` | `listarEixosComRoadmap()` — retorna eixos com roadmaps ordenados por status |
| `AcoesInovacaoService` | `dadosTabelas()` — agrupa e filtra ações por categoria, calcula totais e percentual |
| `RegulamentacoesService` | `listar()` — retorna regulamentações ordenadas por data |

Todos os métodos possuem `try/catch` com `Log::error` e `abort(500)`.

---

### Controllers refatorados

| Controller | Alteração |
|---|---|
| `EixoController` | Removida toda lógica de banco e de negócio; injeta `EixoService`; métodos `index` e `show` reduzidos a orquestração de requisição/resposta |
| `RoadmapController` | Injeta `RoadmapService`; lógica de query removida do controller |
| `AcoesInovacaoController` | Injeta `AcoesInovacaoService`; todas as queries e cálculos movidos para o service |
| `PlanoDiretorController` | Reutiliza `RoadmapService` (a lógica era idêntica ao `RoadmapController`) |
| `RegulamentacoesController` | Injeta `RegulamentacoesService` |

Padrão adotado em todos: `try/catch` no controller com `Log::error` + `abort(500)`, além do mesmo tratamento já presente nos services.

Constantes (`EIXOS_ICONS`, `ODS_MAP`) que estavam inline no `EixoController` foram movidas para `EixoService` como constantes de classe privadas, eliminando duplicação e facilitando manutenção.

---

## Front-end

### `hero.css`
- Adicionado `min-height: 100vh` e `display: flex; align-items: center` na `.hero` para ocupar a viewport inteira.
- Fonte do título reduzida de `3rem` para `2.6rem`; parágrafo de `1.2rem` para `1.05rem`.
- Stat number reduzido de `2rem` para `1.9rem`.
- Botões reduzidos de `padding: 15px 30px` para `13px 28px`.
- Container posicionado com `z-index: 1` para ficar sobre os elementos de fundo animados.
- Responsividade mobile revisada: `min-height: auto` em telas menores que 768px para evitar espaço excessivo.

### `objetivos.css`
- `.objetivo-titulo` recebe explicitamente `font-family: var(--heading-font)` — corrige a mistura entre `sans-serif` e `system-ui` que ocorria na página "Gestão Centrada no Munícipe" e demais eixos.
- `.legend-item` e filtros de objetivos recebem `font-family: var(--default-font)` explícito para consistência.
- `section-title-obj h1` e `p` com família tipográfica e tamanhos padronizados.
- `#objetivos` recebe `min-height: 100vh`; removido em breakpoints menores que 768px para não estourar a viewport no mobile.
- Padding interno dos cards (`.objetivos-content`) aumentado de `20px` para `20px 18px` com ajuste no mobile para `16px 14px`.
- Altura fixa dos cards removida no breakpoint `992px` — estava quebrando o layout em tablets; substituída por `height: 100%` com flexbox.
- Responsividade mobile revisada: espaçamentos, tamanhos de fonte e imagens ODS reduzidos progressivamente.

### `principios.css`
- Toda a seção reescrita com `font-family` explícitos em cada bloco para eliminar herança implícita de `system-ui` que causava inconsistência tipográfica.
- Padding dos cards ajustado de `30px 20px` para `28px 24px` para texto não encostar nas bordas.
- Título do card reduzido de `1.25rem` para `1.1rem`.
- CTA: padding reduzido de `50px 40px` para `48px 36px`; tamanhos de fonte levemente reduzidos.
- Todos os `h3`, `h4`, `h5` recebem `font-family: var(--heading-font)` explícito.
- Parágrafos e conteúdos de texto recebem `font-family: var(--default-font)` explícito.

### `main.css`
- Variáveis `:root` movidas para o topo do arquivo (ordem lógica).
- `section` com `padding` aumentado de `30px 0` para `60px 0` para melhor respiro vertical.
- `.primeira-sessao` adicionada com `padding-top: 80px` para páginas internas (evita sobreposição do header fixo).
- `min-height: 100vh` aplicado via seletor às seções `#regulamentacoes`, `#tabelas`, `#roadmap` e `#artigos`.
- `.section-titulo` criada como classe alternativa para títulos de seção em páginas internas (complementa `.section-title` existente).
- `.iniciativas` com `padding` ajustado de `20px` para `20px 18px`.
- Código duplicado e comentários excessivos removidos.
