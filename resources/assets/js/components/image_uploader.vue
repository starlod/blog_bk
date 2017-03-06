<template>
    <div id="image_uploader" class="well">
        <div id="drop-box" class="drop-box"
             :class="{ dragging: isDragging }"
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
            <input type="file" class="hidden" id="files" name="files" multiple @change="onChangeFiles">
        </div>
        <p class="form-control-static">最大アップロードサイズ: 20MB</p>
        <ul>
            <li v-for="(item, index) in items">
                <b>{{ item.name }}</b> {{ item.size|number_format }} bytes.
            </li>
            <li v-for="(error, index) in errors">
                <b>{{ error }}</b>
            </li>
        </ul>
    </div>
</template>

<style lang="scss">

.drop-box {
    background-color: #f5f5f5;
    border: 4px dashed #b4b9be;
    border-radius: 10px;
    width: 100%;
    height: 200px;
    display: flex;
    flex-direction: column-reverse;
}
.dragging {
    border-color: #1aa;
}
.drag-drop-inside {
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
                errors: [],
                isDragging: false
            }
        },
        mounted() {
            if (!window.FileReader) {
                alert("File API がサポートされていません。");
            }
        },
        methods: {
            onFileSelect(e) {
                document.getElementById('files').click();
            },
            onChangeFiles(files) {
                var self = this;
                _.forEach(document.getElementById('files').files, function(file, key) {
                    if (self.isValid(file)) {
                        self.saveUploadFile(file);
                    }
                });

                this.isDragging = false;
            },
            onDragLeave(e) {
                this.isDragging = false;
            },
            onDragOver(e) {
                e.stopPropagation();
                e.preventDefault();
                e.dataTransfer.dropEffect = 'copy';
                this.isDragging = true;
            },
            onDrop(e) {
                e.preventDefault();
                var self = this;

                _.forEach(e.dataTransfer.files, function(file, key) {
                    if (self.isValid(file)) {
                        self.saveUploadFile(file);
                    }
                });

                this.isDragging = false;
            },
            onDragEnd(e) {
                e.preventDefault();
                this.isDragging = false;
            },
            isValid(file) {
                // あとでバリデーションを書く
                return true;
            },
            saveUploadFile(file) {
                var self = this;
                var formData = new FormData();
                formData.append("file", file);
                api.post('/images', formData).then(function (response) {
                    self.items.push(file);
                    self.$emit('onUploaded');
                }).catch(function (error) {
                    self.errors.push(file.name + ' ファイルのアップロードに失敗しました。');
                });
            }
        },
    }
</script>
