## Social Book with Django

El proyecto consta de 5 carpetas generales y 2 archivos extra:
- /core
- /media
- /social_book 
- /static
- /templates
- db.sqlite3
- manage.py

A continuación se explicará la función de cada uno.

#### /core
Se encuentran los archivos principales de la página.

###### /\_\_pycache\_\_
<sub>Es el directorio donde se almacena todo el código precompilado en bytecode que genera el intérprete.</sub>

###### /migations
<sub>Cada vez que se hace un cambio en un modelo de la aplicación se genera un archivo automático en esta carpeta. Estos archivos contienen instrucciones sobre cómo aplicar o deshacer los cambios en la base de datos.</sub>

###### __init__.py
<sub>Este archivo se utiliza para indicar que el directorio donde está debe ser tratado como un paquete.</sub>

###### admin.py
<sub>Es el backend de la página. De esta forma, el usuario con rol de administrador podrá acceder al contenido del perfil, los posts, los likes y los seguidores de los usuarios de la aplicación.</sub>

###### apps.py
<sub>Es el archivo de configuración del core de la aplicación.</sub>

###### models.py
<sub>Es el archivo donde se crean las diferentes clases a utilizar. En este caso se han creado las clases Profile, Post, LikePost y FollowersCount.</sub>

###### tests.py
<sub>Es un archivo que se utiliza para ejecutar comandos de prueba, de esta manera se pueden evitar grandes problemas.</sub>

###### urls.py
<sub>Es el archivo donde se encuentran todas las direcciones de la aplicación.</sub>

###### views.py
<sub>Es el archivo donde se encuentran todas las funciones de la aplicación.</sub>

<sub>Contiene diferentes funciones que explicaré detalladamente:</sub>

    -------------------
    index 
    -------------------

    # Si el usuario no ha iniciado sesión redirige a la página de "signin"
    @login_required(login_url='signin')
    def index(request):
        # Obtiene el perfil del usuario actual
        user_object = User.objects.get(username=request.user.username)
        user_profile = Profile.objects.get(user=user_object)

        # Crea una lista vacía para almacenar los usuarios que el usuario actual sigue
        user_following_list = []
        # Crea una lista vacía para almacenar el contenido del feed
        feed = []

        # Obtiene una lista de usuarios que el usuario actual sigue
        user_following = FollowersCount.objects.filter(follower=request.user.username)

        # Añade los usuarios a la lista de seguimiento
        for users in user_following:
            user_following_list.append(users.user)

        # Obtiene las publicaciones de los usuarios y las agrega a la feed
        for usernames in user_following_list:
            feed_lists = Post.objects.filter(user=usernames)
            feed.append(feed_lists)

        # Combina todas las listas de feed en una sola lista
        feed_list = list(chain(*feed))

        # Obtiene una lista de todos los usuarios en la base de datos
        all_users = User.objects.all()
        
        # Crea una lista vacía para almacenar usuarios que el usuario actual sigue
        user_following_all = []

        # Obtiene los usuarios correspondientes
        for user in user_following:
            user_list = User.objects.get(username=user.user)
            user_following_all.append(user_list)

        # Crea una lista de sugerencias donde aparecen usuarios que no son el usuario actual ni los usuarios a los que sigue
        new_suggestions_list = [x for x in list(all_users) if (x not in list(user_following_all))]
        current_user = User.objects.filter(username=request.user.username)
        final_suggestions_list = [x for x in list(new_suggestions_list) if ( x not in list(current_user))]
        # Mezcla la lista de sugerencias de manera aleatoria
        random.shuffle(final_suggestions_list)

        # Crea una lista vacía para almacenar los IDs de usuario de las sugerencias
        username_profile = []
        # Crea una lista vacía para almacenar los perfiles de usuario de las sugerencias
        username_profile_list = []

        # Obtiene los IDs de usuario y los añade a la lista
        for users in final_suggestions_list:
            username_profile.append(users.id)

        # Obtiene los perfiles de los usuarios y los añade a la lista
        for ids in username_profile:
            profile_lists = Profile.objects.filter(id_user=ids)
            username_profile_list.append(profile_lists)

        # Combina todas las listas en una sola lista
        suggestions_username_profile_list = list(chain(*username_profile_list))

        # Devuelve los datos de 4 sugerencias.
        return render(request,'index.html', {'user_profile': user_profile, 'posts': feed_list,
                    'suggestions_username_profile_list': suggestions_username_profile_list[:4]})
    
    -------------------
    upload
    -------------------
    -------------------
    search
    -------------------
    -------------------
    like_post
    -------------------
    -------------------
    profile
    -------------------
    -------------------
    follow
    -------------------
    -------------------
    settings
    -------------------
    -------------------
    signup
    -------------------
    -------------------
    signin
    -------------------
    -------------------
    logout
    -------------------
#### /media
Es la carpeta que guarda el contenido multimedia de la aplicación que puede ser editado por el usuario (publicaciones y fotos de perfil).

###### /post_images
<sub>Es la carpeta que guarda todos los posts de la aplicación.</sub>

###### /profile_images
<sub>Es la carpeta que guarda todas las fotos de perfil de la aplicación.</sub>

###### blank-profile-picture.png
<sub>Es la foto de perfil por defecto de todos los usuarios.</sub>

#### /social_book

###### /\_\_pycache\_\_
<sub>Es el directorio donde se almacena todo el código precompilado en bytecode que genera el intérprete.</sub>

###### __init__.py
<sub>Este archivo se utiliza para indicar que el directorio donde está debe ser tratado como un paquete. De esta manera django detecta que /social_book es una aplicación.</sub>

###### asgi.py
<sub>Este archivo define como la aplicación web debe interactuar con Django.</sub>

###### settings.py
<sub>Es el archivo de configuración de la aplicación.</sub>

###### urls.py
<sub>Es el archivo de configuración de las urls de la aplicación.</sub>

###### wsgi.py
<sub>Se encarga de configurar y comunicar la aplicación con el servidor web.</sub>

#### /static
Es la carpeta que se utiliza para almacenar archivos estáticos, como imágenes, hojas de estilo CSS y scripts JavaScript. Los archivos en esta carpeta se procesan desde el navegador del cliente por tanto se consigue una optimización en el servidor web.

#### /templates
Es la carpeta donde se encuentran todas las plantillas de la aplicación web. Es decir, los archivos a los que el usuario podrá acceder. En este caso los archivos son:
- index.html
- profile.html
- search.html
- settings.html
- signin.html
- signup.html

#### db.sqlite3
Es el archivo que se encarga de la base de datos de la aplicación. Este archivo se actualiza cada vez que se hace una migración.

#### manage.py
Este archivo contiene un script que ayuda a interactuar con el proyecto. Este script se puede utilizar para iniciar el servidor, hacer migraciones, crear superusuarios o crear comandos personalizados entre otras cosas.