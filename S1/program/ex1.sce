[s,Fs,bits] = wavread('aiueo.wav');
clf
plot(s(1,:));
wavwrite(s,11025,8, 'aiueo1.wav')
wavwrite(s,22050,8, 'aiueo2.wav')
wavwrite(s,44100,8, 'aiueo3.wav')
wavwrite(s,11025,16,'aiueo4.wav')
wavwrite(s,44100,16,'aiueo5.wav')
