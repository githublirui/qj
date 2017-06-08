@echo off
echo Convert SPHERE to CUBE droplet
echo %~1
echo.

IF "%~1" == "" GOTO ERROR
IF NOT EXIST "%~1" GOTO ERROR

FOR %%V in (%*) do "%~dp0\ktransform" -config=convertdroplets.config "%%~V"
echo %%V
GOTO DONE

:ERROR
echo.
echo Usage:
echo.
echo - Drag and drop spherical panorama images on this droplet
echo   to convert them to cubical panorama images.
echo.
echo.
echo Settings:
echo.
echo - See the "convertdroplets.config" file for settings 
echo   regarding output imageformat or compression.
echo.
echo.

:DONE
echo.
pause
