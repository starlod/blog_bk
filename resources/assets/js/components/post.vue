<template>
    <div id="post" class="container">
        <div class="card">
            <div class="card-header">
                {{ item.title }}
            </div>
            <div class="card-block">
                <vue-markdown># Hello, Vue.js\n\n- hoge\n- foo\n- bar</vue-markdown>
            </div>
            <div class="card-footer">
                <a :href="url + '/edit'" class="btn btn-primary">編集</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            id: {
                type: Number,
                required: true,
            }
        },
        data() {
            return {
                url: '/posts/' + this.id,
                item: {
                    id: '',
                    title: '',
                    content: '',
                },
                input: '# Hello, Vue.js\n\n- hoge\n- foo\n- bar',
            }
        },
        computed: {
        },
        mounted() {
            var self = this;

            api.get(this.url).then(function (response) {
                let json = JSON.parse(response.request.responseText);
                self.item = json;
            }).catch(function (error) {
                console.error(error);
            });
        },
        methods: {
            compiledMarkdown: function () {
                console.log(this.content);
                return marked(this.content);
            },
        }
    }
</script>
