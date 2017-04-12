<template>

    <div id="posts">
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>内容</th>
                    <th>投稿者</th>
                    <th>更新日</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in items">
                    <td>{{ item.id }}</td>
                    <td><a :href="url(item.id)">{{ item.title }}</a></td>
                    <td>{{ item.content }}</td>
                    <td>{{ item.author.name }}</td>
                    <td>{{ item.updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: {
            items: {
                type: Array,
                required: true,
            }
        },
        data() {
            return {
            }
        },
        mounted() {
        },
        methods: {
            url(id) {
                return APP_URL + '/posts/' + id;
            }
        }
    }
</script>
