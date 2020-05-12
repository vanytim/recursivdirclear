@ECHO OFF

set DIRS = dir %1

  FOR /L %%A IN (DIRS) DO (
  ECHO %%A
  

pause