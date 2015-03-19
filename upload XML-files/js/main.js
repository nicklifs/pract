$(function(){
	var fileContainer = $('#file-container'); // input � ����� file
	var dropContainer = $('#drop-container'); // �������, ����������� drag'n'drop
	var progressContainer = $('#progress-container'); // ���������� ��������
	var progressBarContainer = $('#progress-bar-container');
	var error = $('#error'); // ���� ��� ��������� �� �������
	var progress_array = new Array(); // ������ �� ���������� ��������� ��� ����������� ������
	var in_progress_count = 0; // ���-�� ����������� ������
	var finished_count = 0; // ���-�� ����������� ������

	// �������� ��������� FileAPI
	var FileAPiSupport = (function(undefined) {
		return $("<input type='file'>")
		.get(0)
		.files !== undefined;
	})();
   
  // ���� ��������������
  if(FileAPiSupport)
  {
	
    // ������� ������ �������� � ����� � ���������� ��������� � ��������� drag'n'drop
    $('#file-submit').remove();
    $('#file-api').show();

    fileContainer.change(function() {
		upload(this.files);
		$('form').get(0).reset();
    })

    // ������������ ���� �� ������� � drag'n'drop
    dropContainer.bind({
		dragenter: function() {
			$('#file-api,#drop-message').toggle();
			return false;
		},
		dragover: function() {
			return false;
		},
		dragleave: function() {
			$('#file-api,#drop-message').toggle();
			return false;
		},
		drop: function(e) {
			$('#file-api,#drop-message').toggle();
			var dt = e.originalEvent.dataTransfer;
			upload(dt.files);
			return false;
		}
    });

    // ������ �� ������ ������ � �������� �� �� ��������
    upload = function (files)
    {
		error.empty().hide();

		$.each(files, function(i, file) {
			if (!file.type.match(/.*xml/)) {
			  error.append(file.name+' - �� ��������; ');
			  return true;
			}
			progressContainer.show();
			progress_array[in_progress_count] = 0;
			uploadFile(file, in_progress_count++);
		})

		if(error.html())
			error.show();
    }

    // �������� ����� � ������� XHR
    uploadFile = function (file, i) {
		if (file) {
			var xhr = new XMLHttpRequest();
			xhrUpload = xhr.upload;

			xhrUpload.addEventListener('progress', function(event) {
				if (event.lengthComputable) {
					updateProgress(i, Math.round((event.loaded / event.total) * 100));
				}
			}, false);

			xhrUpload.addEventListener('load', function(event) {
				// ���� ���-�� ����������� ������ ����� ������ ���-��, �� ���������� �������� � ��������� ��������
				if(++finished_count == in_progress_count)
				{
					progressContainer.hide();
					progress_array = new Array();
					in_progress_count = 0;
					finished_count = 0;

					reload('/view.php');
				}
			}, false);

			xhrUpload.addEventListener('error', function(event) {
				updateProgress(i, 100);
			}, false);

			xhr.open('POST', 'upload.php');
			xhr.setRequestHeader('Cache-Control', 'no-cache');
			xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
			xhr.setRequestHeader("X-File-Name", file.name);
			xhr.send(file);
		}
    }

    // ������� ����������� ��������
    updateProgress = function (i, value)
    {
		progress_array[i] = value;

		var count = 0;

		for(i in progress_array)
			count = count+progress_array[i];

		var progress = count / (progress_array.length * 100) * 100;
		var false_progress = Math.round(progress);

		progressBarContainer.css('width',false_progress+'%');
    }
  }

	setTimeout('reload("/view.php");', 50);

	//������������� ������
	reload = function (url)
	{
		$('#page_loader,#page_loader>img').show();

		$.ajax({
		  url: url,
		  cache: false,
		  success: function(response){
			$('#content').html(response);
		  }
		});
	}

	// ��� ����� �� ����� � ������, ��������� ��� �������� ��������
	$(document).on('click','#xml_list a', function(){
		$(this).next().show();
		reload(this.href);

		return false;
	})

	// ��� ����� �� ��������, ���������� ���������� �� ����
	$(document).on('click','#node_list li:not(.active) a', function(){
		var self = this;
		var loader = $(this).next();
		loader.show();
		

		$.get(this.href, function(response){
		  $(self).parent().addClass('active').after(response);
		  loader.hide();
		})
		
		$(this).attr('href', '#');
		
		return false;
	})
})