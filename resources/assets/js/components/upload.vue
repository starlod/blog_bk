<template>
    <div>
        <div id="drop-box" class="drop-box"
             v-bind:class="{ dragging: isDragging }"
             @dragleave="onDragLeave"
             @dragover="onDragOver"
             @drop="onDrop"
             @dragend="onDragEnd">
            <div class="drag-drop-inside">
                <p>ここにファイルをドロップ</p>
                <p>または</p>
                <p>
                    <input type="button" value="ファイルを選択" class="btn btn-default" @click="onFileSelect">
                </p>
            </div>
            <input type="file" class="hidden" id="files" name="files" multiple>
        </div>
        <p>最大アップロードサイズ: 20MB</p>
        <ul>
            <li v-for="(item, index) in items">
                <b>{{ item.name }}</b> {{ item.size|number_format }} bytes.
            </li>
        </ul>
    </div>
</template>

<style lang="css">

.drop-box {
    position: relative;
    background-color: #f5f5f5;
    border: 4px dashed #b4b9be;
    border-radius: 10px;
    width: 100%;
    height: 200px;
}
.dragging {
    border-color: #1aa;
}
.drag-drop-inside {
    position: absolute;
    width: 400px;
    height: 120px;
    bottom: 0;
    left: 0;
    right: 0;
    margin: auto;
}
.drag-drop-inside p {
    text-align: center;
}

</style>

<script>
    export default {
        data() {
            return {
                items: [],
                isDragging: false
            }
        },
        mounted() {
            var self = this

            if (!window.FileReader) {
                alert("File API がサポートされていません。");
            }
        },
        methods: {
            onFileSelect: function(e) {
                $('#files').click();
            },
            onDragLeave: function(e) {
                console.log('onDragLeave')
                this.isDragging = false;
            },
            onDragOver: function(e) {
                console.log('onDragOver')
                e.stopPropagation();
                e.preventDefault();
                e.dataTransfer.dropEffect = 'copy';
                this.isDragging = true;
            },
            onDrop: function(e) {
                console.log('onDrop')
                e.preventDefault();
                var self = this

                _.forEach(e.dataTransfer.files, function(file, key) {
                    self.items.push(file);
                    var formData = new formData();
                    formData.append("file", file);
                    api.post('/images', formData).then(function (response) {
                        console.log(response);
                    }).catch(function (error) {
                        console.log(error);
                    });
                });
            },
            onDragEnd: function(e) {
                console.log('onDragEnd')
                e.preventDefault();
            }
        },
    }
</script>
