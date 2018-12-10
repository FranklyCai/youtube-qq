this.initiate = function (sourceFile) {
    if (!window.MediaSource || !MediaSource.isTypeSupported('video/webm; codecs="vp8,vorbis"')) {
        self.setState("Your browser is not supported");
        return;
    }
    self.clearUp();
    self.sourceFile = sourceFile;
    self.setState("Creating media source using");
    //create the video element
    self.videoElement = $('<video controls></video>')[0];
    //create the media source
    self.mediaSource = new MediaSource();
    self.mediaSource.addEventListener('sourceopen', function () {
        self.setState("Creating source buffer");
    //when the media source is opened create the source buffer
        self.createSourceBuffer();
    }, false);
    //append the video element to the DOM
    self.videoElement.src = window.URL.createObjectURL(self.mediaSource);
    $('#basic-player').append($(self.videoElement));
}
this.clearUp = function () {
    if (self.videoElement) {
        //clear down any resources from the previous video embed if it exists
        $(self.videoElement).remove();
        delete self.mediaSource;
        delete self.sourceBuffer;
    }
}