<template>
       <i class="fa fa-2x fa-heart" @click="likedPost()"  :class="{ 'text-danger': isLikedLocal }">
            {{likesCountLocal}}
       </i>
</template>

<script>
export default {

    props: ['is_liked', 'post_id', 'likes_count'],

    data() {
        return {
            isLikedLocal: false,
            likesCountLocal: 0,
        }
    },
    mounted() {
        if (this.is_liked) {
            this.isLikedLocal = true
        }
        this.likesCountLocal = this.likes_count

    },
    methods: {
        likedPost() {
            axios.post('/posts/' + this.post_id + '/like')
            .then(response => {
                this.likesCountLocal = response.data.likes_count,
                this.isLikedLocal = response.data.is_liked
            })
        }
    }
}
</script>

<style>
.fa-heart {
    cursor: pointer;
 }
 </style>