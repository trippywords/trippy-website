var quill=null;
/**
       * Step1. select local image
       *
       */
function selectLocalImage() {
  const input = document.createElement('input');
  input.setAttribute('type','file');
  input.click();

  // Listen upload local image and save to server
  input.onchange = () => {
    const file = input.files[0];

    // file type is only image.
    if (/^image\//.test(file.type)) {
      imageHandler(file);
    } else {
      console.warn('You could only upload images.');
    }
  };
}

function imageHandler(image) {
  //console.log(image);
  var formData = new FormData();
  formData.append('image', image);
  formData.append('_token', $('meta[name=csrf-token]').attr("content"));

  var url = $('#editor').data('imageUrl');
  
  $.ajax({
    method:'POST',
    url: url,
    data: formData,
    processData:false,
    contentType:false,
    success: function (response) {
      //console.log(response);
      if(response.url){
        insertToEditor(response.url,quill);
      }
    }

  });
}

/**
     * Step3. insert image url to rich editor.
     *
     * @param {string} url
     */
    function insertToEditor(url,editor) {
      // push image url to rich editor.
      const range = editor.getSelection();
      editor.insertEmbed(range.index, 'image', url);
    }

$(document).ready(function(){
        var toolbarOptions=[
        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        ['bold','italic','underline','strike'],
        ['blockquote','code-block'],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],               // custom button values
        
        [{ 'script': 'sub'}, { 'script': 'super' }],  
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],    // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                         // text direction
        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['link','image','video','formula'],
        ['clean'] 
        ];


 quill = new Quill('#editor', {
    modules:{
        toolbar:toolbarOptions
    },
    theme: 'snow',
    placeholder:'Start Posting Something'
  });


  // quill editor add image handler
    quill.getModule('toolbar').addHandler('image', () => {
        selectLocalImage();
    });



  quill.on('text-change', function(delta, oldDelta, source) {
      $('#content-txtckDescription').text($(".ql-editor").html());
     })
});
  
