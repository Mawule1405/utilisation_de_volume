# ----------------DEBUT COUCHE OS ------------------------
    FROM debian:stable-slim
    # Définit l'image de base comme étant une version allégée de Debian (stable-slim),
    # optimisée pour la conteneurisation avec des fonctionnalités minimales.
    
    # ---------------FIN COUCHE OS -------------------------
    
    # METADONNEES DE L'IMAGE
    LABEL version="1.0" maintainer="HELOU Komlan Mawulé <helkmawule@gmail.com>"
    # Ajoute des métadonnées à l'image, incluant la version et le mainteneur.
    
    # VARIABLES TEMPORAIRES
    ARG APT_FLAGS="-q -y"
    # Définit une variable temporaire pour simplifier les commandes `apt-get`.
    # `-q` : Mode silencieux, `-y` : Accepte toutes les confirmations automatiquement.
    
    ARG DOCUMENTROOT="/var/www/html"
    # Définit le répertoire de base où seront copiés les fichiers de l'application.
    
    # ------------ DEBUT COUCHE APACHE -------------------
    RUN apt-get update -y &&\
        apt-get install ${APT_FLAGS} apache2
    # Met à jour la liste des paquets et installe Apache2 (serveur HTTP).
    # `&&` enchaîne les commandes pour éviter l'exécution partielle en cas d'erreur.
    
    # ------------ FIN COUCHE APACHE ------------------
    
    # ------------ DEBUT COUCHE MYSQL --------------------
    RUN apt-get install ${APT_FLAGS} mariadb-server
    # Installe MariaDB, une solution open-source pour MySQL.
    
    COPY db/etudiants.sql /
    # Copie le fichier SQL nécessaire à l'initialisation de la base de données dans le conteneur.
    # Ici, on suppose que le fichier `etudiants.sql` est dans le dossier `db` du contexte de construction.
    
    # ----------FIN COUCHE MYSQL ------------
    
    RUN apt-get install ${APT_FLAGS} \
        php-mysql \
        php && \
        rm -f ${DOCUMENTROOT}/index.html && \
        apt-get autoclean -y
    # Installe PHP et l'extension `php-mysql` pour interagir avec MariaDB.
    # Supprime le fichier `index.html` par défaut d'Apache.
    # Effectue un nettoyage automatique pour réduire la taille de l'image.
    
    COPY app ${DOCUMENTROOT}
    # Copie les fichiers de l'application dans le répertoire Apache (`DOCUMENTROOT`).
    
    # ----------------- FIN COUCHE PHP -----------------
    
    # OUVERTURE DU PORT HTTP
    EXPOSE 80
    # Indique que le port 80 sera utilisé pour la communication HTTP.
    # Ce port sera mappé avec un port de la machine hôte via `docker run`.
    
    # REPERTOIRE DE TRAVAIL
    WORKDIR ${DOCUMENTROOT}
    # Définit le répertoire courant par défaut dans le conteneur.
    
    # DEMARRAGE DES SERVICES LORS DE L EXECUTION DE L'IMAGE
    ENTRYPOINT service mariadb start && mariadb < /etudiants.sql && apache2ctl -D FOREGROUND
    # Démarre MariaDB, initialise la base de données avec le fichier SQL, puis démarre Apache en mode premier plan.
    # Cela garantit que le conteneur continue de s'exécuter tant qu'Apache est actif.