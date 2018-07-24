<template>
    <i class="fa fa-2x fa-eye">
        {{viewsCountLocal}}
    </i>
</template>

<script>
    export default {
        props: ['post_id', 'views_count'],

        data() {
            return {
                viewsCountLocal: 0,
            }
        },

        mounted() {
           this.viewsCountLocal = this.views_count;
           this.viewPost();
        },
        methods: {
            viewPost() {
                axios.post('/posts/' + this.post_id + '/view')
                    .then(response => {
                        this.viewsCountLocal = response.data.views_count
                    })
            }
        }
    }
</script>