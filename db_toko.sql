PGDMP         0                w            db_toko    10.8    10.8                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false            	           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false            
           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                       1262    33917    db_toko    DATABASE     �   CREATE DATABASE db_toko WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE db_toko;
             postgres    false                        2615    2200    public    SCHEMA        CREATE SCHEMA public;
    DROP SCHEMA public;
             postgres    false                       0    0    SCHEMA public    COMMENT     6   COMMENT ON SCHEMA public IS 'standard public schema';
                  postgres    false    3                        3079    12924    plpgsql 	   EXTENSION     ?   CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;
    DROP EXTENSION plpgsql;
                  false                       0    0    EXTENSION plpgsql    COMMENT     @   COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';
                       false    1            �            1259    33928    barang    TABLE     �   CREATE TABLE public.barang (
    kodebarang character varying(10) NOT NULL,
    namabarang character varying(100) NOT NULL,
    hargabarang integer NOT NULL
);
    DROP TABLE public.barang;
       public         postgres    false    3            �            1259    43681    detail    TABLE     �   CREATE TABLE public.detail (
    no_faktur character varying(10),
    kodebarang character varying(10),
    banyakbarang integer,
    id_detail integer NOT NULL
);
    DROP TABLE public.detail;
       public         postgres    false    3            �            1259    58493    detail_id_detail_seq    SEQUENCE     �   CREATE SEQUENCE public.detail_id_detail_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.detail_id_detail_seq;
       public       postgres    false    200    3                       0    0    detail_id_detail_seq    SEQUENCE OWNED BY     M   ALTER SEQUENCE public.detail_id_detail_seq OWNED BY public.detail.id_detail;
            public       postgres    false    201            �            1259    43671    faktur    TABLE     �   CREATE TABLE public.faktur (
    no_faktur character varying(10) NOT NULL,
    id_pembeli character varying(10),
    id_kasir character varying(10)
);
    DROP TABLE public.faktur;
       public         postgres    false    3            �            1259    33938    kasir    TABLE     �   CREATE TABLE public.kasir (
    id_kasir character varying(10) NOT NULL,
    namakasir character varying(100) NOT NULL,
    username character varying(50),
    password character varying(50)
);
    DROP TABLE public.kasir;
       public         postgres    false    3            �            1259    33933    pembeli    TABLE     �   CREATE TABLE public.pembeli (
    id_pembeli character varying(10) NOT NULL,
    namapembeli character varying(100) NOT NULL,
    alamatpembeli character varying(100) NOT NULL
);
    DROP TABLE public.pembeli;
       public         postgres    false    3            ~
           2604    58495    detail id_detail    DEFAULT     t   ALTER TABLE ONLY public.detail ALTER COLUMN id_detail SET DEFAULT nextval('public.detail_id_detail_seq'::regclass);
 ?   ALTER TABLE public.detail ALTER COLUMN id_detail DROP DEFAULT;
       public       postgres    false    201    200                       0    33928    barang 
   TABLE DATA               E   COPY public.barang (kodebarang, namabarang, hargabarang) FROM stdin;
    public       postgres    false    196   ^                 0    43681    detail 
   TABLE DATA               P   COPY public.detail (no_faktur, kodebarang, banyakbarang, id_detail) FROM stdin;
    public       postgres    false    200   �                 0    43671    faktur 
   TABLE DATA               A   COPY public.faktur (no_faktur, id_pembeli, id_kasir) FROM stdin;
    public       postgres    false    199   �                 0    33938    kasir 
   TABLE DATA               H   COPY public.kasir (id_kasir, namakasir, username, password) FROM stdin;
    public       postgres    false    198   �                 0    33933    pembeli 
   TABLE DATA               I   COPY public.pembeli (id_pembeli, namapembeli, alamatpembeli) FROM stdin;
    public       postgres    false    197                     0    0    detail_id_detail_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.detail_id_detail_seq', 38, true);
            public       postgres    false    201            �
           2606    33932    barang barang_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.barang
    ADD CONSTRAINT barang_pkey PRIMARY KEY (kodebarang);
 <   ALTER TABLE ONLY public.barang DROP CONSTRAINT barang_pkey;
       public         postgres    false    196            �
           2606    43675    faktur faktur_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.faktur
    ADD CONSTRAINT faktur_pkey PRIMARY KEY (no_faktur);
 <   ALTER TABLE ONLY public.faktur DROP CONSTRAINT faktur_pkey;
       public         postgres    false    199            �
           2606    33942    kasir kasir_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.kasir
    ADD CONSTRAINT kasir_pkey PRIMARY KEY (id_kasir);
 :   ALTER TABLE ONLY public.kasir DROP CONSTRAINT kasir_pkey;
       public         postgres    false    198            �
           2606    33937    pembeli pembeli_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.pembeli
    ADD CONSTRAINT pembeli_pkey PRIMARY KEY (id_pembeli);
 >   ALTER TABLE ONLY public.pembeli DROP CONSTRAINT pembeli_pkey;
       public         postgres    false    197                )   x�s40�tN,*���0 .GCN�Բ�bNC�@� �R�            x������ � �            x������ � �         9   x��60�tL�,��N,�,2�462��60��/Ȅ�AŌ9�K��!��`�=... S��            x������ � �     