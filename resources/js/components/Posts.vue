<template>
    <div class="padding">
        <div>
            <p class="text-lg font-semibold">
                O que precisa para colocar um site no ar? (Hover, Forge e DigitalOcean)
            </p>
        </div>

        <div class="text-sm">
            <div>
                <p class="padding-top">
                    Para esse primeiro post, eu pensei em algo que todo desenvolvedor precisa saber: <span class="italic">
                    como colocar um site no ar</span>?
                </p>

                <p>
                    Apesar de ser um pouco complicado, essa habilidade é exigida pela maioria das empresas.

                    Exitem varios websites que alugam serivdores e websites para voce comprar o dominio.

                    Eu vou citar aqui os que eu conheço e que eu acho que bons para quem está começando.
                </p>
            </div>
            <div>
                <a href="https://www.hover.com/" >
                    <p class="mt-8 font-semibold text-blue hover:underline pointer">
                        Hover
                    </p>
                </a>
                <p class="mt-3">
                    Hover é um bom lugar pra comecar e comprar seu dominio. Os valores irao variar de acordo com
                    o nome do seu website.
                </p>
            </div>

            <div>
                <a href="https://forge.laravel.com/" >
                    <p class="mt-8 font-semibold text-blue hover:underline pointer">
                        Forge
                    </p>
                </a>
                <p class="mt-3">
                    Com Forge a gente consegue gerenciar nossos servidores. Especialmente se você trabalhar com
                    Laravel. Pois Forge foi criado especialment para projestos Laravel, e esse ferramenta com certeza
                    deixa a vida dos desenvolvedores mais facil. E ainda podemos configurar as filas e até
                    ter o certificado TLS.
                    O plano mais barato custa $12 mensalmente e você tem 5 dias para testar.
                </p>
            </div>

            <div>
                <a href="https://www.digitalocean.com/" >
                    <p class="mt-8 font-semibold text-blue hover:underline pointer">
                        DigitalOcean
                    </p>
                </a>
                <p class="mt-3">
                    DigitalOcean nos permite alugar servidores. Resumindo: nos permite <span class="italic">
                    alugar o espaço que o nosso website vai ficar na internet</span>.

                    É possível integrar Forge com DigitalOcean, juntando as duas ferramentas, o gerenciamento
                    dos servidores se torna mais fácil, pois você pode se concentrar apenas em Forge para "implantar" seu website.
                </p>
            </div>
        </div>




    </div>
</template>

<script>
export default {
    name: "Posts"
}
</script>

<style scoped>
.padding-top {
    padding-top: 44px;
}

.padding {
    padding: 30px;
}
</style>
