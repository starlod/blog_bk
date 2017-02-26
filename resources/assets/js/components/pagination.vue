<template>
    <nav>
        <ul class="pagination" v-show="last_page > 0">
            <li class="disabled">
                <a>
                    {{ current_page }}/{{ last_page }}
                </a>
            </li>
            <li v-show="current_page > 2">
                <a @click="load(1)" aria-label="最初のページへ">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                </a>
            </li>
            <li v-show="current_page > 1">
                <a @click="load(current_page - 1)" aria-label="前のページへ">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </li>
            <li v-for="n in last_page"
                :class="n === current_page ? 'active' : ''">
                <a @click="load(n)">{{ n }}</a>
            </li>
            <li v-show="current_page < last_page">
                <a @click="load(current_page + 1)" aria-label="次のページへ">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </li>
            <li v-show="current_page < last_page - 1">
                <a @click="load(1)" aria-label="最後のページへ">
                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>

    export default {
        props: {
            url: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                current_page: 1,
                last_page: 0,
            }
        },
        mounted() {
            let parameters = getParameters();
            var page = 1;
            if (parameters.page) {
                page = parameters.page
            }
            this.load(page);
        },
        computed: {
        },
        methods: {
            isActive: function(n) {
                return n === current_page;
            },
            load: function(page = 1) {
                var self = this;

                if (this.last_page !== 0 && page > this.last_page) {
                    return false;
                } else if (page < 1) {
                    return false;
                }

                api.get(this.url, {
                    params: {
                        page: page
                    }
                }).then(function (response) {
                    let json = JSON.parse(response.request.responseText);
                    self.$parent.items = json.data;
                    self.makePagination(json);
                }).catch(function (error) {
                    console.log(error);
                });
            },
            makePagination: function(json) {
                this.current_page = json.current_page;
                this.last_page = json.last_page;
            }
        }
    }
</script>
