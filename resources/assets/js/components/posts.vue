<template>
    <div>
        <div class="posts panel panel-primary" v-for="post in posts">
            <div class="title panel-heading">{{ post.title }}</div>
            <div class="panel-body">
                {{ post.body }}
            </div>
        </div>
        <pagination></pagination>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                posts: []
            }
        },
        mounted() {
            var self = this

            api.get('/posts').then(function (response) {
                self.posts = JSON.parse(response.request.responseText)
                console.log(self.posts);
            }).catch(function (error) {
                console.log(error);
            })
        }
    }
</script>
