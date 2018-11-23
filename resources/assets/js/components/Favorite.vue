<template>
    <span>
        <a href="#" v-if="isFavorited" @click.prevent="unFavorite(topic)" style="text-decoration:none;">
            <span class="glyphicon glyphicon-heart" style="color:#F4645F"></span> 取消收藏
        </a>
        <a href="#" v-else @click.prevent="favorite(topic)" style="text-decoration:none;">
            <span class="glyphicon glyphicon-heart-empty"></span> 收藏
        </a>
    </span>
</template>

<script>
    export default {
        props: ['topic', 'favorited'],

        data: function() {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = this.isFavorite ? true : false;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(topic) {
                axios.post('/favorite/'+topic)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(topic) {
                axios.post('/unfavorite/'+topic)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>