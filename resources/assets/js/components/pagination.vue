<template>
    <nav>
        <ul class="pagination" v-show="pagination.last_page > 0">
            <li class="disabled">
                <a>
                    {{ pagination.current_page }}/{{ pagination.last_page }}
                </a>
            </li>
            <li v-show="pagination.current_page > 2">
                <a @click="load(1)" aria-label="最初のページへ">
                    <i class="fa fa-angle-double-left" aria-hidden="true"></i>
                </a>
            </li>
            <li v-show="pagination.current_page > 1">
                <a @click="load(pagination.current_page - 1)" aria-label="前のページへ">
                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                </a>
            </li>
            <li v-for="n in pagination.last_page"
                :class="n === pagination.current_page ? 'active' : ''">
                <a @click="load(n)">{{ n }}</a>
            </li>
            <li v-show="pagination.current_page < pagination.last_page">
                <a @click="load(pagination.current_page + 1)" aria-label="次のページへ">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            </li>
            <li v-show="pagination.current_page < pagination.last_page - 1">
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
            pagination: {
                type: Object,
                required: true,
            }
        },
        data() {
            return {

            }
        },
        mounted() {
        },
        computed: {
        },
        methods: {
            load: function(page) {
                this.$parent.reload(page);
            },
            isActive: function(n) {
                return n === pagination.current_page;
            }
        }
    }
</script>
