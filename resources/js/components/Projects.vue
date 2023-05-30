<template>
    <div class="card-container">
        <div v-for="website in websites" :key="website.id" class="card">
            <div class="card-image">
                <a :href="website.url" target="_blank">
                    <img :src="website.image" alt="Website Screenshot" class="website-image" />
                </a>
            </div>
            <h2>{{ website.title }}</h2>
            <p >{{ website.description }}</p>
        </div>
    </div>

</template>

<script>

export default {
    name: "Projects",
    data() {
        return {
            isFlipped: false,
            websites: [
                {
                    id: 1,
                    title: 'OpenLitterMap',
                    description: '2022 - Now',
                    image: '/img/olm.png',
                    url: 'https://openlittermap.com/',
                },
            ]
        };
    },
    methods: {
        openWebsite(website) {
            window.open(website.url, '_blank');
        }
    }
}
</script>

<style scoped>
.card-container {
    display: flex;
    justify-content: center;
    margin: 3em;
}

.card {
    width: 88%;
    height: 468px;
    background-color: #030029;
    position: relative;
    border-radius: 8px;
    display: grid;
    place-items: center;
    overflow: hidden;
}

.card-image {
    margin: 0.5em;
    position: relative;
    overflow: hidden;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
    z-index: 2;
}

.card-image:hover {
    opacity: 0.8;
}

.card h2 {
    font-family: system-ui;
    font-size: 2rem;
    color: white;
    text-transform: uppercase;
    text-align: center;
    z-index: 2;
}

.card p {
    color: #ffa3fd;
    z-index: 2;
}

.card::before {
    content: "";
    position: absolute;
    width: 203%;
    height: 145px;
    background-image: linear-gradient(
        180deg,
        #865dff,
        #e384ff
    );
    animation: rotate 3s linear infinite;
}

.card::after {
    content: "";
    position: absolute;
    inset: 8px;
    background-color: #030029;
    border-radius: inherit;
}

@keyframes rotate {
    100% {
        rotate: 360deg;
    }

}

.visit-link {
    z-index: 2;
}
</style>
