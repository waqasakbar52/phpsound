// Fix up prefixing
window.AudioContext = window.AudioContext || window.webkitAudioContext;


Array.prototype.max = function() {
  return Math.max.apply(null, this);
};

var SoundCloudWaveform = {

	settings : {
		canvas_width: 453,
		canvas_height: 66,
		bar_width: 3,
		bar_gap : 0.2,
		wave_color: "#666",
		download: false,
		onComplete: function(png, pixels) {}
	},

	audioContext: new AudioContext(),

	generate: function(url, options) {

		// preparing canvas
		this.settings.canvas = document.createElement('canvas');
		this.settings.context = this.settings.canvas.getContext('2d');

		this.settings.canvas.width = (options.canvas_width !== undefined) ? parseInt(options.canvas_width) : this.settings.canvas_width;
		this.settings.canvas.height = (options.canvas_height !== undefined) ? parseInt(options.canvas_height) : this.settings.canvas_height;

		// setting fill color
		this.settings.wave_color = (options.wave_color !== undefined) ? options.wave_color : this.settings.wave_color;

		// setting bars width and gap
		this.settings.bar_width = (options.bar_width !== undefined) ? parseInt(options.bar_width) : this.settings.bar_width;
		this.settings.bar_gap = (options.bar_gap !== undefined) ? parseFloat(options.bar_gap) : this.settings.bar_gap;

		this.settings.download = (options.download !== undefined) ? options.download : this.settings.download;

		this.settings.onComplete = (options.onComplete !== undefined) ? options.onComplete : this.settings.onComplete;

		// read file buffer
		var request = new XMLHttpRequest();
		request.open('GET', url, true);
		request.responseType = 'arraybuffer';

		  // Decode asynchronously
		request.onload = function() {
			SoundCloudWaveform.audioContext.decodeAudioData(request.response, function(buffer) {
                SoundCloudWaveform.extractBuffer(buffer);
            });
		}
		request.send();
    },

	extractBuffer: function(buffer) {
	    buffer = buffer.getChannelData(0);
		console.log(buffer)
	    var sections = this.settings.canvas.width;
	    var len = Math.floor(buffer.length / sections);
		
	    var maxHeight = this.settings.canvas.height;
	    var vals = [];
	    for (var i = 0; i < sections; i += this.settings.bar_width) {
	        vals.push(this.bufferMeasure(i * len, len, buffer) * 10000);
	    }

	    for (var j = 0; j < sections; j += this.settings.bar_width) {
	        var scale = maxHeight / vals.max();
	        var val = this.bufferMeasure(j * len, len, buffer) * 10000;
	        val *= scale;
	        val += 1;
			
	        this.drawBar(j, val);
	    }

	    if (this.settings.download) {
	    	this.generateImage();
	    }
	    this.settings.onComplete(this.settings.canvas.toDataURL('image/png'), this.settings.context.getImageData(0, 0, this.settings.canvas.width, this.settings.canvas.height));
	    // clear canvas for redrawing
	    this.settings.context.clearRect(0, 0, this.settings.canvas.width, this.settings.canvas.height);
    },

    bufferMeasure: function(position, length, data) {
        var sum = 0.0;
        for (var i = position; i <= (position + length) - 1; i++) {
            sum += Math.pow(data[i], 2);
        }
		
       var data = Math.sqrt(sum / data.length);
    },

    drawBar: function(i, h) {

    	this.settings.context.fillStyle = this.settings.wave_color;

		var w = this.settings.bar_width;
        if (this.settings.bar_gap !== 0) {
            w *= Math.abs(1 - this.settings.bar_gap);
        }
        var x = i + (w / 2),
            y = this.settings.canvas.height - h;

        this.settings.context.fillRect(x, y, w, h);
    },

    generateImage: function() {
    	var image = this.settings.canvas.toDataURL('image/png');

    	var link = document.createElement('a');
    	link.href = image;
    	link.setAttribute('download', '');
    	link.click();
    }
}