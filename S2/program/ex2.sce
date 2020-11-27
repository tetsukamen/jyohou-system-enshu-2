clear;
[s0,fs,bits] = wavread('original.wav');
s0 = s0(1,:); // stereo -> mono
length_of_s = length(s0);

ap = 0.25;
as = 0.4;
dp = round(0.050*fs); // EX-2.3
ds = round(0.025*fs); // EX-2.3

rs = 10;

a = zeros(1,rs+2);
a(1) = 1;
a(2) = ap;

for k=1:rs,
    a(k+2) = 
end

d = zeros(1,rs+2);
d(1) = 0;
d(2) = dp;

for k=1:rs,
    d(k+2) = [＿EX-2.2 ＿];
end

s1 = zeros(1,length_of_s);
for n = 1:length_of_s,
    for k = 1:rs+2,
        if n-d(k)>0 // EX-2.4
            s1(n) = s1(n)+a(k)*s0(n-d(k));
        end
    end
end
wavwrite(s1,fs,bits,'echo.wav') // EX-2.6
