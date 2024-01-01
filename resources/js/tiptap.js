import route from 'ziggy-js'
import axios from '@axios'

import {
  VuetifyTiptap,
  VuetifyViewer,
  createVuetifyProTipTap,
  BaseKit,
  Bold,
  Italic,
  Underline,
  Strike,
  Color,
  Highlight,
  Heading,
  TextAlign,
  FontFamily,
  FontSize,
  SubAndSuperScript,
  BulletList,
  OrderedList,
  TaskList,
  Indent,
  Link,
  Image,
  Video,
  Table,
  Blockquote,
  HorizontalRule,
  Code,
  CodeBlock,
  Clear,
  Fullscreen,
  History,
} from "vuetify-pro-tiptap"

import "vuetify-pro-tiptap/style.css"

export const vuetifyProTipTap = createVuetifyProTipTap({
  lang: "en",
  components: {
    VuetifyTiptap,
    VuetifyViewer,
  },
  extensions: [
    BaseKit.configure({
      placeholder: {
        placeholder: "Enter some text...",
      },
    }),
    Bold,
    Italic,
    Underline,
    Strike,
    Heading,
    TextAlign,
    FontFamily,
    FontSize,
    Color,
    Highlight.configure({ divider: true }),
    // SubAndSuperScript.configure({ divider: true }),
    Clear.configure({ divider: true }),
    BulletList,
    OrderedList,
    // TaskList,
    // Indent.configure({ divider: true }),
    Link,
    // Image.configure({

    //   divider: true,


    //   // hiddenTabs: ['upload'],
    //   upload(file) {
    //     // Define the upload URL
    //     const url = route('admin.recruit-hub.upload')

    //     // Create a new FormData object
    //     const formData = new FormData()

    //     // Append the file to the FormData object
    //     formData.append("file", file)

    //     // Send a POST request to the upload URL with the FormData object
    //     return axios.post(url, formData).then(response => {
    //       // Return the URL of the uploaded file
    //       return response.data.url
    //     })
    //   },

    //   // return Promise.resolve(url)
    // }),
    // Video,
    // Table,
    Blockquote,
    HorizontalRule,
    History.configure({ divider: true }),
  ],
})
