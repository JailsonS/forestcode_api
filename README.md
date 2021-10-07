## DESCRIÇÃO GERAL

<p>
    Este projeto visa o desenvolvimento de uma ferramenta que automatiza a leitura e a interpretação da Lei 12.651/20 mais conhecido como Código Florestal (CF). Esta lei é aplicada a todos os imóveis rurais nos diferentes biomas do Brasil, estabelecendo obrigatoriedades e instrumentos para proteção da vegetação nativa.  
</p>

<p>
    Este documento é divido em 4 seções:
</p>

1. PRINCIPAIS CONCEITOS
2. REGRAS GERAIS RELACIONADOS AO CF
3. TECNOLOGIAS UTILIZADAS
4. PRODUTOS GERADOS

### Principais Conceitos

 - RESERVAL LEGAL (RL): área localizada no interior de uma propriedade ou posse rural, com a função de assegurar o uso econômico de modo sustentável dos recursos naturais do imóvel rural
 - ÁREA DE PRESERVAÇÃO PERMANENTE (APP): área protegida, coberta ou não por vegetação nativa, com a função ambiental de preservar os recursos hídricos, a paisagem, a estabilidade geológica e a biodiversidade, facilitar o fluxo gênico de fauna e flora, proteger o solo e assegurar o bem-estar das populações humanas
 - ÁREA RURAL CONSOLIDADA: área de imóvel rural com ocupação antrópica preexistente a 22 de julho de 2008, com edificações, benfeitorias ou atividades agrossilvipastoris, admitida, neste último caso, a adoção do regime de pousio
 - CADASTRO AMBIENTAL RURAL (CAR): instrumento estabelecido pelo CF onde são cadastradas as áreas de APP, RL, Uso Antrópico, entre outras.

### Regras Gerais Relacionadas ao Código Florestal

<P>
    Esta aplicação irá trabalhar os principais conceitos e regras estabelecidas no CF com intuito de avaliar a conformidade dos imóveis rurais em relação ao mesmo. Abaixo, segue os principais parâmetros para análise da adequação ambiental do imóvel:
</P>

- APP conservada (APPRF)
- APP desmatada com restauração obrigatória (APPD)
- APP desmatada sem restauração obrigatória (APPC)
- APP Total = APPRF + APPD + APPC

- RL exigida: área de RL exigida para que o imóvel esteja minimamente regularizado em relação ao CF
- RL conservada: área de RL com vegetação nativa dentro do imóvel
- RL desmatada pós 2008 (passivo em RL): área de RL desmatada após 22/07/2008, sendo a sua restauração obrigatória por meio de técnicas para plantio inloco
- RL desmatada compensável: área de RL desmatada antes de 22/07/2008, passivel de compensação da vegetação desmatada em outro imóvel
- RL excedente: área de RL superior à RL exigida
- 
<P>
    As etapas necessárias para o cálculo dos itens acima estão expressos abaixo
</P>

1. Reserva Legal (RL)
    - Cálculo da RL exigida para regularização do imóvel rural (RL exigida)
        - RL exigida para imóveis até 4 módulos fiscais (MF)
            - Etapas
                1. Calcular o % de vegetação nativa em 22/07/2008
                2. Calcular o % de vegetação nativa atual
                3. Calcular a área desmatada após 22/07/2008
            - Cenários estabelecidos pelo CF
                - Regra geral estabelecida pelo Art. 12 lei 12.651/2012
                    - a) 80% do imóvel em imóvel situado em áreas de floresta
                    - b) 35% do imóvel em imóvel situado em cerrado
                    - c) 20% do imóvel em imóvel situado em campos gerais
                - Cenários de redução do % de RL exigida válidos para nos casos da alínea 'a)'
                    - § 4º art. 12 poder público poderá reduzir a RL para 50% (somente fins de recomposição) SE:
                        1. Estado com mais de 50% do seu território ocupado por UC regularizada e TI homologada 
                    - § 5º art. 12 poder público ESTADUAL (ouvido COEMA) poderá reduzir para 50% (somente fins de recomposição) SE:
                        1. Estado possuir Zoneamento Ecológico Econômico (ZEE) aprovado
                        2. Estado possuir mais de 65% do seu território ocupado por UC regularizada e TI homologada 
                    - art. 13 inciso I
                        1. Reduzir para fins de <strong>reguralização</strong> para até 50% da propriedade, a RL de imóveis com área consolidada 
            - cômputo da APP no cálculo do % de RL
                1. Não implique em novos desmatamentos
                2. Área esteja conservada ou em processo de recuperação
                3. o proprietário ou possuidor do imóvel tenha requerido o CAR
    - Passivo em RL
        - Área desmatada após 22/07/2008 sem respaldo legal (DF PÓS 2008)
        - DF PÓS 2008 + % de área desmatada antes 22/07/2008 necessária para atingir o % de RL exigido 
    - Cota de Reserva Ambiental (CRA) e Excedente de RL
        - Condições para gerar CRA:
            1. Imóvel sob regime de servidão ambiental 
            2. Correspondente à área de RL instituída sobre a vegetação que exceder os percentuais exigidos no art. 12
            3. RPPN
            4. Vegetação em imóvel no interior de UC 
            5. Pequenas propriedades rurais podem gerar CRA da vegetação NATIVA que integra a RL (art. 44 § 4º)
            6. Proprietários com área de veg nat superior a 50% e não desmataram ilegalmente de acordo com a legislação em vigor à época (art. 68 § 2º)
2. Área de Preservação Permanente (APP)