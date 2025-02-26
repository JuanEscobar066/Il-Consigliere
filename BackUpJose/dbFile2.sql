PGDMP         *    
            w            proyecto    11.2    11.2 L    x           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            y           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            z           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false            {           1262    16476    proyecto    DATABASE     �   CREATE DATABASE proyecto WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Spanish_Costa Rica.1252' LC_CTYPE = 'Spanish_Costa Rica.1252';
    DROP DATABASE proyecto;
             postgres    false            �            1259    16648    adjuntos_punto    TABLE     �   CREATE TABLE public.adjuntos_punto (
    id_punto integer NOT NULL,
    ruta character varying NOT NULL,
    nombre character varying,
    tipo character varying
);
 "   DROP TABLE public.adjuntos_punto;
       public         postgres    false            �            1259    16522    sesion_id_seq    SEQUENCE     v   CREATE SEQUENCE public.sesion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 $   DROP SEQUENCE public.sesion_id_seq;
       public       postgres    false            �            1259    16524    events    TABLE     �   CREATE TABLE public.events (
    id integer DEFAULT nextval('public.sesion_id_seq'::regclass) NOT NULL,
    lugar character varying(500) NOT NULL,
    hora time without time zone NOT NULL,
    fecha date NOT NULL,
    tipo_sesion integer NOT NULL
);
    DROP TABLE public.events;
       public         postgres    false    201            �            1259    16624    miembro    TABLE       CREATE TABLE public.miembro (
    idmiembro integer NOT NULL,
    nombremiembro character varying(50),
    apellido1miembro character varying(50),
    apellido2miembro character varying(50),
    correo character varying(200),
    contrasenna character varying(200),
    rol integer
);
    DROP TABLE public.miembro;
       public         postgres    false            �            1259    16622    miembro_idmiembro_seq    SEQUENCE     �   ALTER TABLE public.miembro ALTER COLUMN idmiembro ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.miembro_idmiembro_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       postgres    false    208            �            1259    24878    miembrosconvocados    TABLE     �   CREATE TABLE public.miembrosconvocados (
    idmiembrosconvocados integer NOT NULL,
    ideventoconvocado integer,
    idmiembroconvocado integer,
    convocado integer
);
 &   DROP TABLE public.miembrosconvocados;
       public         postgres    false            �            1259    24876 +   miembrosconvocados_idmiembrosconvocados_seq    SEQUENCE       ALTER TABLE public.miembrosconvocados ALTER COLUMN idmiembrosconvocados ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.miembrosconvocados_idmiembrosconvocados_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       postgres    false    217            �            1259    16496 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         postgres    false            �            1259    16494    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public       postgres    false    197            |           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
            public       postgres    false    196            �            1259    16515    password_resets    TABLE     �   CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 #   DROP TABLE public.password_resets;
       public         postgres    false            �            1259    16639    punto_agenda    TABLE     �   CREATE TABLE public.punto_agenda (
    id_punto integer NOT NULL,
    titulo character varying,
    fecha date,
    miembro integer,
    considerando text,
    acuerda text,
    estado boolean,
    punto_para_agenda integer
);
     DROP TABLE public.punto_agenda;
       public         postgres    false            �            1259    16637    punto_agenda_id_punto_seq    SEQUENCE     �   CREATE SEQUENCE public.punto_agenda_id_punto_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 0   DROP SEQUENCE public.punto_agenda_id_punto_seq;
       public       postgres    false    210            }           0    0    punto_agenda_id_punto_seq    SEQUENCE OWNED BY     W   ALTER SEQUENCE public.punto_agenda_id_punto_seq OWNED BY public.punto_agenda.id_punto;
            public       postgres    false    209            �            1259    24828    reseteo_contrasennas    TABLE     �   CREATE TABLE public.reseteo_contrasennas (
    idreseteo integer NOT NULL,
    correo character varying(200),
    tokenreseteo character varying(100)
);
 (   DROP TABLE public.reseteo_contrasennas;
       public         postgres    false            �            1259    24826 "   reseteo_contrasennas_idreseteo_seq    SEQUENCE     �   ALTER TABLE public.reseteo_contrasennas ALTER COLUMN idreseteo ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.reseteo_contrasennas_idreseteo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       postgres    false    213            �            1259    24844    reseteocontrasennas    TABLE     �   CREATE TABLE public.reseteocontrasennas (
    idreseteo integer NOT NULL,
    correo character varying(200),
    tokenreseteo character varying(300)
);
 '   DROP TABLE public.reseteocontrasennas;
       public         postgres    false            �            1259    24842 !   reseteocontrasennas_idreseteo_seq    SEQUENCE     �   ALTER TABLE public.reseteocontrasennas ALTER COLUMN idreseteo ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.reseteocontrasennas_idreseteo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       postgres    false    215            �            1259    16617    roles    TABLE     %  CREATE TABLE public.roles (
    idrole integer NOT NULL,
    descripcionrole character varying(256),
    agregarmiembro integer,
    eliminarmiembro integer,
    administrarpuntos integer,
    administraradministrativo integer,
    administrarpresidente integer,
    proponerpuntos integer
);
    DROP TABLE public.roles;
       public         postgres    false            �            1259    16615    roles_idrole_seq    SEQUENCE     �   ALTER TABLE public.roles ALTER COLUMN idrole ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.roles_idrole_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public       postgres    false    206            �            1259    16531    tipo_sesion    TABLE     `   CREATE TABLE public.tipo_sesion (
    id integer NOT NULL,
    nombre character varying(250)
);
    DROP TABLE public.tipo_sesion;
       public         postgres    false            �            1259    16534    tipo_sesion_id_seq    SEQUENCE     {   CREATE SEQUENCE public.tipo_sesion_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 )   DROP SEQUENCE public.tipo_sesion_id_seq;
       public       postgres    false    203            ~           0    0    tipo_sesion_id_seq    SEQUENCE OWNED BY     I   ALTER SEQUENCE public.tipo_sesion_id_seq OWNED BY public.tipo_sesion.id;
            public       postgres    false    204            �            1259    16504    users    TABLE     x  CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.users;
       public         postgres    false            �            1259    16502    users_id_seq    SEQUENCE     u   CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.users_id_seq;
       public       postgres    false    199                       0    0    users_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;
            public       postgres    false    198            �
           2604    16536    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    196    197    197            �
           2604    16642    punto_agenda id_punto    DEFAULT     ~   ALTER TABLE ONLY public.punto_agenda ALTER COLUMN id_punto SET DEFAULT nextval('public.punto_agenda_id_punto_seq'::regclass);
 D   ALTER TABLE public.punto_agenda ALTER COLUMN id_punto DROP DEFAULT;
       public       postgres    false    209    210    210            �
           2604    16537    tipo_sesion id    DEFAULT     p   ALTER TABLE ONLY public.tipo_sesion ALTER COLUMN id SET DEFAULT nextval('public.tipo_sesion_id_seq'::regclass);
 =   ALTER TABLE public.tipo_sesion ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    204    203            �
           2604    16538    users id    DEFAULT     d   ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);
 7   ALTER TABLE public.users ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    198    199    199            o          0    16648    adjuntos_punto 
   TABLE DATA               F   COPY public.adjuntos_punto (id_punto, ruta, nombre, tipo) FROM stdin;
    public       postgres    false    211   �Y       f          0    16524    events 
   TABLE DATA               E   COPY public.events (id, lugar, hora, fecha, tipo_sesion) FROM stdin;
    public       postgres    false    202   @Z       l          0    16624    miembro 
   TABLE DATA               y   COPY public.miembro (idmiembro, nombremiembro, apellido1miembro, apellido2miembro, correo, contrasenna, rol) FROM stdin;
    public       postgres    false    208   �Z       u          0    24878    miembrosconvocados 
   TABLE DATA               t   COPY public.miembrosconvocados (idmiembrosconvocados, ideventoconvocado, idmiembroconvocado, convocado) FROM stdin;
    public       postgres    false    217   S[       a          0    16496 
   migrations 
   TABLE DATA               :   COPY public.migrations (id, migration, batch) FROM stdin;
    public       postgres    false    197   �[       d          0    16515    password_resets 
   TABLE DATA               C   COPY public.password_resets (email, token, created_at) FROM stdin;
    public       postgres    false    200   \       n          0    16639    punto_agenda 
   TABLE DATA               z   COPY public.punto_agenda (id_punto, titulo, fecha, miembro, considerando, acuerda, estado, punto_para_agenda) FROM stdin;
    public       postgres    false    210   ,\       q          0    24828    reseteo_contrasennas 
   TABLE DATA               O   COPY public.reseteo_contrasennas (idreseteo, correo, tokenreseteo) FROM stdin;
    public       postgres    false    213   �\       s          0    24844    reseteocontrasennas 
   TABLE DATA               N   COPY public.reseteocontrasennas (idreseteo, correo, tokenreseteo) FROM stdin;
    public       postgres    false    215   h`       j          0    16617    roles 
   TABLE DATA               �   COPY public.roles (idrole, descripcionrole, agregarmiembro, eliminarmiembro, administrarpuntos, administraradministrativo, administrarpresidente, proponerpuntos) FROM stdin;
    public       postgres    false    206   �`       g          0    16531    tipo_sesion 
   TABLE DATA               1   COPY public.tipo_sesion (id, nombre) FROM stdin;
    public       postgres    false    203   �`       c          0    16504    users 
   TABLE DATA               u   COPY public.users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at) FROM stdin;
    public       postgres    false    199   a       �           0    0    miembro_idmiembro_seq    SEQUENCE SET     D   SELECT pg_catalog.setval('public.miembro_idmiembro_seq', 22, true);
            public       postgres    false    207            �           0    0 +   miembrosconvocados_idmiembrosconvocados_seq    SEQUENCE SET     Z   SELECT pg_catalog.setval('public.miembrosconvocados_idmiembrosconvocados_seq', 20, true);
            public       postgres    false    216            �           0    0    migrations_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.migrations_id_seq', 2, true);
            public       postgres    false    196            �           0    0    punto_agenda_id_punto_seq    SEQUENCE SET     G   SELECT pg_catalog.setval('public.punto_agenda_id_punto_seq', 5, true);
            public       postgres    false    209            �           0    0 "   reseteo_contrasennas_idreseteo_seq    SEQUENCE SET     Q   SELECT pg_catalog.setval('public.reseteo_contrasennas_idreseteo_seq', 44, true);
            public       postgres    false    212            �           0    0 !   reseteocontrasennas_idreseteo_seq    SEQUENCE SET     P   SELECT pg_catalog.setval('public.reseteocontrasennas_idreseteo_seq', 1, false);
            public       postgres    false    214            �           0    0    roles_idrole_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.roles_idrole_seq', 4, true);
            public       postgres    false    205            �           0    0    sesion_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.sesion_id_seq', 29, true);
            public       postgres    false    201            �           0    0    tipo_sesion_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.tipo_sesion_id_seq', 4, true);
            public       postgres    false    204            �           0    0    users_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.users_id_seq', 1, true);
            public       postgres    false    198            �
           2606    16655 "   adjuntos_punto adjuntos_punto_pkey 
   CONSTRAINT     l   ALTER TABLE ONLY public.adjuntos_punto
    ADD CONSTRAINT adjuntos_punto_pkey PRIMARY KEY (id_punto, ruta);
 L   ALTER TABLE ONLY public.adjuntos_punto DROP CONSTRAINT adjuntos_punto_pkey;
       public         postgres    false    211    211            �
           2606    16631    miembro miembro_pkey 
   CONSTRAINT     Y   ALTER TABLE ONLY public.miembro
    ADD CONSTRAINT miembro_pkey PRIMARY KEY (idmiembro);
 >   ALTER TABLE ONLY public.miembro DROP CONSTRAINT miembro_pkey;
       public         postgres    false    208            �
           2606    24882 *   miembrosconvocados miembrosconvocados_pkey 
   CONSTRAINT     z   ALTER TABLE ONLY public.miembrosconvocados
    ADD CONSTRAINT miembrosconvocados_pkey PRIMARY KEY (idmiembrosconvocados);
 T   ALTER TABLE ONLY public.miembrosconvocados DROP CONSTRAINT miembrosconvocados_pkey;
       public         postgres    false    217            �
           2606    16501    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public         postgres    false    197            �
           2606    16647    punto_agenda punto_agenda_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.punto_agenda
    ADD CONSTRAINT punto_agenda_pkey PRIMARY KEY (id_punto);
 H   ALTER TABLE ONLY public.punto_agenda DROP CONSTRAINT punto_agenda_pkey;
       public         postgres    false    210            �
           2606    24832 .   reseteo_contrasennas reseteo_contrasennas_pkey 
   CONSTRAINT     s   ALTER TABLE ONLY public.reseteo_contrasennas
    ADD CONSTRAINT reseteo_contrasennas_pkey PRIMARY KEY (idreseteo);
 X   ALTER TABLE ONLY public.reseteo_contrasennas DROP CONSTRAINT reseteo_contrasennas_pkey;
       public         postgres    false    213            �
           2606    24851 ,   reseteocontrasennas reseteocontrasennas_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.reseteocontrasennas
    ADD CONSTRAINT reseteocontrasennas_pkey PRIMARY KEY (idreseteo);
 V   ALTER TABLE ONLY public.reseteocontrasennas DROP CONSTRAINT reseteocontrasennas_pkey;
       public         postgres    false    215            �
           2606    16621    roles roles_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (idrole);
 :   ALTER TABLE ONLY public.roles DROP CONSTRAINT roles_pkey;
       public         postgres    false    206            �
           2606    16540    events sesion_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.events
    ADD CONSTRAINT sesion_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.events DROP CONSTRAINT sesion_pkey;
       public         postgres    false    202            �
           2606    16542    tipo_sesion tipo_sesion_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.tipo_sesion
    ADD CONSTRAINT tipo_sesion_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.tipo_sesion DROP CONSTRAINT tipo_sesion_pkey;
       public         postgres    false    203            �
           2606    16514    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public         postgres    false    199            �
           2606    16512    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public         postgres    false    199            �
           1259    16521    password_resets_email_index    INDEX     X   CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);
 /   DROP INDEX public.password_resets_email_index;
       public         postgres    false    200            �
           2606    16656 +   adjuntos_punto adjuntos_punto_id_punto_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.adjuntos_punto
    ADD CONSTRAINT adjuntos_punto_id_punto_fkey FOREIGN KEY (id_punto) REFERENCES public.punto_agenda(id_punto) ON DELETE CASCADE;
 U   ALTER TABLE ONLY public.adjuntos_punto DROP CONSTRAINT adjuntos_punto_id_punto_fkey;
       public       postgres    false    211    2775    210            �
           2606    24900    punto_agenda miembro    FK CONSTRAINT     |   ALTER TABLE ONLY public.punto_agenda
    ADD CONSTRAINT miembro FOREIGN KEY (miembro) REFERENCES public.miembro(idmiembro);
 >   ALTER TABLE ONLY public.punto_agenda DROP CONSTRAINT miembro;
       public       postgres    false    208    2773    210            �
           2606    16632    miembro miembro_rol_fkey    FK CONSTRAINT     w   ALTER TABLE ONLY public.miembro
    ADD CONSTRAINT miembro_rol_fkey FOREIGN KEY (rol) REFERENCES public.roles(idrole);
 B   ALTER TABLE ONLY public.miembro DROP CONSTRAINT miembro_rol_fkey;
       public       postgres    false    208    206    2771            �
           2606    24888 <   miembrosconvocados miembrosconvocados_ideventoconvocado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.miembrosconvocados
    ADD CONSTRAINT miembrosconvocados_ideventoconvocado_fkey FOREIGN KEY (ideventoconvocado) REFERENCES public.events(id);
 f   ALTER TABLE ONLY public.miembrosconvocados DROP CONSTRAINT miembrosconvocados_ideventoconvocado_fkey;
       public       postgres    false    217    202    2767            �
           2606    24883 =   miembrosconvocados miembrosconvocados_idmiembroconvocado_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.miembrosconvocados
    ADD CONSTRAINT miembrosconvocados_idmiembroconvocado_fkey FOREIGN KEY (idmiembroconvocado) REFERENCES public.miembro(idmiembro);
 g   ALTER TABLE ONLY public.miembrosconvocados DROP CONSTRAINT miembrosconvocados_idmiembroconvocado_fkey;
       public       postgres    false    2773    208    217            �
           2606    24905    punto_agenda punto_para    FK CONSTRAINT     �   ALTER TABLE ONLY public.punto_agenda
    ADD CONSTRAINT punto_para FOREIGN KEY (punto_para_agenda) REFERENCES public.events(id);
 A   ALTER TABLE ONLY public.punto_agenda DROP CONSTRAINT punto_para;
       public       postgres    false    2767    202    210            �
           2606    16543    events sesion_tipo_sesion_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.events
    ADD CONSTRAINT sesion_tipo_sesion_fkey FOREIGN KEY (tipo_sesion) REFERENCES public.tipo_sesion(id);
 H   ALTER TABLE ONLY public.events DROP CONSTRAINT sesion_tipo_sesion_fkey;
       public       postgres    false    203    2769    202            o   b   x�3�,(M��L�7�wN,()-JTHIU(H�+I��IT020��50�52T04�35�31�+�K�$Em��)�S<��X(���S-Ж=... ��:      f   B   x�3��t.N�44�20 "N#CK]3]#NC.#KN��Լ�T�D��D�PNC4e�F�F\1z\\\ 8?�      l   �   x���M
�0�דÔ&Tmw����j�F�f�w�^̶���MA�b��`~2�Q����w����V��X�o�E�&��` cJw�Pj+;y�
Ϥ�`BcL��g��N����#�8�Ǒ"��t��2ifm.0���!y�=�u��+������^��_���4?if>!��)a�� �߹p      u   T   x�%���0�7�m�K��#,���Ih�xJ��	LL���R��26M�:yk�(�D-�Pg&��~���;Q�U�rT�      a   H   x�3�4204�74�74�7 ����Ē����Ԣ���Ĥ�TNC.#d��(
����R�R�SKZb���� ]      d      x������ � �      n   W   x�3��+M-��420��50�54�4��KLIL��%��%�F\F���E��
A��@!�`B��֔�h$�*##��*������ ��      q   �  x�}�G��F���c1>@���"g!�xB��Ԡ&��zߡ'xߠ���o`���9!�y�w����W5�?e\�2;o�Դ�
�!�όh�?""�ǧZ���f��%�:�YbX5�4������)D8ڎ#�;��@��o.�3��0�\3(�!�9�r��ܨ�AW�87������	���/�O�Mj�gkm"Sm�[�?�Ov3�#�D �;�w�S���g�G��1����!��.�.��,mBw��Ѩ��K�Z�N���[�+g�=��0�o�q�yΘ�E	��������$�)'ںK��zݎs� �k{�S_����l*�����E������0�}/,�W�{�BV���H 7� \������Jy�%��S��ڝ�3Kq���r��^�ѕ�3ْ�&�K �re7`�a;�Y������W�7��L���ϱSg���Xi�7N�����\Y$ {�*hi��XF�����yɸ0�}�S���R����YM�E�9,���=�3;! w�F�^���t��76iUm�N�l�V7�_rD��u�ւ4�^�e��l��S.�E<��w��z�y"�Gft���S�큪����]����C1}�КWۍ���-��F�Eq)S�x[���ݭ�

����h<�e!.+��������:���,�K�W���ӛV����C�t�l�<Z�a�']�eeo��i-�ۑ��%�8m�I��9|X&�^聉�������¹�~�����5�ԶSsTńơ�}Vvx�7o�/՚�.2�Q�M��f~b	 *d��[?��F�Hw������kC.��m:��CR[_L��7|ɻg���Ժ�:�6��t�< �HO0��őƶ��|��WD�S2u��YD�g�<撪"�ު�.X��P�BV�	沶ܡ*�)~�p���h�s�ղT��Z	����u�������Gc��6��"�_���      s      x������ � �      j   P   x�3�(J-�LI�+I�4�BNC.#Nǔ�̼�⒢Ē̲|Ic�������" �L8]�KJS2A�����1z\\\ ��l      g   )   x�3��/J��K,�L�2�t�()J̇#I��K��qqq �k      c   �   x�3���)�L�,Q9��zy�%���9z����1~�*F�*�*Q9���UeI�eyf&��������Uin�Q�z�y��f١yi�>YŕA�z �F���ƺ��
FV��V��ĸb���� �(�     