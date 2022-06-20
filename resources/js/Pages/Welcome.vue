<script setup>
import {ref} from 'vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import Logo from '@/Components/Logo';
import Card from '@/Components/Card.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import TextArea from '@/Components/TextArea.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue';


const form = useForm({
  name: '',
  email: '',
  message: '',
  images: [],
});

const pendingUploads = ref([]);
const photoRefs = ref([]);
const photosInput = ref(null);

const selectPhotos = () => {
  photosInput.value.click();
};

const addPhotos = () => {
  Array.from(photosInput.value.files).forEach((file) => {
    // Load the base64 data
    let data = null;
    const reader = new FileReader();

    reader.onload = (e) => {
      data = e.target.result;

      pendingUploads.value.push({
        name: file.name,
        file,
        data,
      });
    };

    reader.readAsDataURL(file);
  });
};

const removePhoto = (index) => {
  pendingUploads.value.splice(index, 1);
};

const submit = () => {
  if (pendingUploads.value.length > 1) {
    form.images = pendingUploads.value.map(f => f.file);
  }

  form.post(route('uploads.post'), {
    errorBag: 'createUpload',
    preserveScroll: true,
    onSuccess: () => clearPhotosInput(),
  });
};

const clearPhotosInput = () => {
  pendingUploads.value = [];
};
</script>

<template>
  <Head title="Welcome"/>

  <div class="relative flex items-top justify-center min-h-screen bg-slate-50 dark:bg-slate-800">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="flex flex-col items-center justify-center pt-8 sm:justify-start">
        <Logo>
          <template #intro>
            <p class="font-semibold text-sm tracking-widest text-slate-800 dark:text-white uppercase mb-6">
              Welcome to
            </p>
          </template>
        </Logo>
      </div>


      <div class="mt-8 border-t border-white">
        <div class="p-6">
          <p class="font-semibold text-sm tracking-wider text-slate-800 dark:text-white">
            {{ $page.props.application.names }} would love to invite you to share your experience of your day with them.
            If you have taken any photo's on your phone that you would like to share with the happy couple, you can do
            so below.
            You can also add an optional message with your upload(s), for {{ $page.props.application.names }} to enjoy
            with your images.
          </p>
        </div>
      </div>

      <div class="mt-8 flex flex-col sm:justify-center items-center">
        <Card>
          <form @submit.prevent="submit">
            <div>
              <Label for="name" value="Name(s)"/>
              <Input
                  id="name"
                  v-model="form.name"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autofocus
              />
            </div>

            <div class="mt-4">
              <Label for="email" value="Email"/>
              <Input
                  id="email"
                  v-model="form.email"
                  type="email"
                  class="mt-1 block w-full"
                  required
                  autofocus
              />
            </div>

            <div class="mt-4">
              <Label for="message" value="Message (optional)"/>
              <TextArea
                  id="message"
                  v-model="form.message"
                  type="text"
                  class="mt-1 block w-full"
                  required
                  autofocus
                  rows="5"
              />
            </div>

            <div class="mt-4">
              <input
                  id="photos"
                  ref="photosInput"
                  type="file"
                  class="hidden"
                  accept="image/*"
                  @change="addPhotos"
                  multiple
              >

              <Label for="photos" value="Images"/>

              <div v-show="pendingUploads.length > 0"
                   class="max-h-60 overflow-auto bg-white border-gray-200 border rounded divide-y">
                <template v-for="(pendingPhoto, index) in pendingUploads" ref="photoRefs">
                  <div class="flex items-center justify-between">
                    <div class="flex items-center">
                    <span
                        class="block w-16 h-16 bg-contain bg-no-repeat bg-center bg-gray-100"
                        :style="'background-image: url(\'' + pendingPhoto.data + '\');'"
                    />

                      <span class="ml-4 text-xs text-black">{{ pendingPhoto.name }}</span>
                    </div>

                    <button class="text-red-600 hover:text-red-400 transition p-4" @click.prevent="() => removePhoto(index)">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                           stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                      </svg>
                    </button>
                  </div>
                </template>
              </div>

              <JetSecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectPhotos">
                Add Photo's
              </JetSecondaryButton>
            </div>

              <div class="flex items-center justify-end mt-4">
                <JetButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                  Submit
                </JetButton>
              </div>
          </form>
        </Card>
      </div>
    </div>
  </div>
</template>
